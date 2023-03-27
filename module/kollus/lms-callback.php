<?php
include "/home/edufim/www/module/class/class.DbCon.php";
include './config.php';

/**
 * @param object $blockInfo
 * @return array
 */
function importFromBlockInfo($blockInfo)
{
    $progressBlocks = array();
    if (isset($blockInfo->block_count) && isset($blockInfo->blocks)) {
        for ($i = 0; $i < $blockInfo->block_count; $i++) {
            $progressBlocks[$i] = array(
                'is_read_block' => isset($blockInfo->blocks->{'b'.$i}) ? (bool)$blockInfo->blocks->{'b'.$i} : false,
                'time' => isset($blockInfo->blocks->{'t'.$i}) ? (int)$blockInfo->blocks->{'t'.$i} : 0,
                'percent' => isset($blockInfo->blocks->{'p'.$i}) ? (int)$blockInfo->blocks->{'p'.$i} : 0,
            );
        }
    }

    return $progressBlocks;
}

/**
 * @param array $progressBlocks
 * @return object
 */
function exportToBlockinfo($progressBlocks)
{
    $blockInfo = (object)array(
        'block_count' => count($progressBlocks),
        'blocks' => (object)array(),
    );

    for ($i = 0; $i < $blockInfo->block_count; $i++) {
        $blockInfo->blocks->{'b'.$i} = (int)$progressBlocks[$i]['is_read_block'];
        $blockInfo->blocks->{'t'.$i} = $progressBlocks[$i]['time'];
        $blockInfo->blocks->{'p'.$i} = $progressBlocks[$i]['percent'];
    }

    return $blockInfo;
}


/**
 * Important : Maybe DB is database wrapper static class.
 *             schema.sql
 */

if (isset($_POST['JSON_DATA']) && isset($_POST['uservalue0'])) {
// if (isset($_POST['JSON_DATA']) && isset($_POST['uservalue0'])) {
    $data = json_decode(stripslashes($_POST['JSON_DATA']));
    $learning_id = $_POST['uservalue0'];

    $userInfo = $data->user_info;
    $contentInfo = $data->content_info;
    $blockInfo = $data->block_info;

    $newProgressBlocks = importFromBlockInfo($blockInfo);
    $startAt = isset($contentInfo->start_at) ? $contentInfo->start_at : null;
    $playtime = isset($contentInfo->playtime) ? $contentInfo->playtime : 0;

    $mediaContentKey = isset($contentInfo->media_content_key) ? $contentInfo->media_content_key : null;
    $clientUserId = isset($userInfo->client_user_id) ? $userInfo->client_user_id : null;
    $playerId = isset($userInfo->player_id) ? $userInfo->player_id : null;

    // $video = DB::table('videos')
    //     ->findOrCreate(array('media_content_key' => $mediaContentKey));
    
    // $user = DB::table('users')
    //     ->findOrCreate(array('client_user_id' => $clientUserId));

    $query = "SELECT id FROM kollus_video WHERE media_content_key='$mediaContentKey'";
    $result = mysql_query($query) or die('Could not connect: ' . mysql_error());
    $num_row = mysql_num_rows($result);
    if ($num_row > 0)  $video_id = mysql_fetch_row($result)[0];
    else die('INVALID VIDEO'.$query);

    $query = "SELECT uid FROM ks_member WHERE userid='$clientUserId'";
    $result = mysql_query($query) or die('Could not connect: ' . mysql_error());
    $num_row = mysql_num_rows($result);
    if ($num_row > 0)  $member_id = mysql_fetch_row($result)[0];
    else die('INVALID USER');

    /**
     * TODO : findOrCreate at progress_relations table
     */
    // $progressRelation = DB::table('progress_relations')
    //     ->findOrCreate(array(
    //         'video_id' => $video->id,
    //         'user_id' => $user->id,
    //     ));

    // $oldProgressBlocks = empty($progressRelation->progress_block_info) ? array() :
    //     importFromBlockInfo(json_decode($progressRelation->progress_block_info));

    $query = "SELECT * FROM kollus_progress_relations WHERE video_id='$video_id' AND member_id='$member_id'";
    $result = mysql_query($query) or die('Could not connect: ' . mysql_error());
    $num_row = mysql_num_rows($result);
    if ($num_row <= 0) mysql_query("INSERT INTO kollus_progress_relations (video_id, member_id, learning_id) VALUES ('$video_id', '$member_id', '$learning_id')") or kollus_log('insert kollus_progres_relations error', mysql_error());
    // else continue;
    
    $progressRelation = mysql_fetch_assoc($result);

    $oldProgressBlocks = empty($progressRelation['progress_block_info']) ? array() :
        importFromBlockInfo(json_decode($progressRelation['progress_block_info']));

    /**
     * TODO : updateOrInsert at progress_datas table
     */
    // DB::table('progress_datas')
    //     ->updateOrInsert(
    //         array(
    //             'progress_relation_id' => $progressRelation->id,
    //             'start_at' => $startAt,
    //         ), // where
    //         array(
    //             'progress_block_info' => json_encode(exportToBlockinfo($newProgressBlocks)),
    //             'playtime' => $playtime,
    //             'player_id' => $playerId,
    //             'updated_at' => time(),
    //         ) // insert or update values
    //     );
    
    $progressRelationId = $progressRelation['id'];
    $progressBlockInfo = json_encode(exportToBlockinfo($newProgressBlocks));
    $updatedAt = time();

    $query = "SELECT * FROM kollus_progress_datas WHERE progress_relation_id='$progressRelationId' AND start_at='$startAt'";
    $result = mysql_query($query) or die('Could not connect: ' . mysql_error());
    $num_row = mysql_num_rows($result);

    $_UPDATE_SQL = "UPDATE kollus_progress_datas SET 
        progress_block_info='$progressBlockInfo', 
        playtime = '$playtime', 
        player_id = '$playerId', 
        updated_at = '$updatedAt' 
        WHERE progress_relation_id='$progressRelationId' AND start_at='$startAt'";
    
    $_INSERT_SQL = "INSERT INTO kollus_progress_datas 
        (progress_relation_id, start_at, progress_block_info, playtime, player_id, updated_at) 
        VALUES ('$progressRelationId', '$startAt', '$progressBlockInfo', '$playtime', '$playerId', '$updatedAt')";

    if ($num_row > 0) mysql_query($_UPDATE_SQL) or die('Could not connect: ' . mysql_error());
    else mysql_query($_INSERT_SQL) or die('Could not connect: ' . mysql_error());

    $updateProgressBlocks = array();
    foreach ($newProgressBlocks as $progressIndex => $newProgressBlock) {
        $oldProgressBlock = $oldProgressBlocks[$progressIndex];
        if (!array_key_exists($progressIndex, $oldProgressBlocks)) {
            $updateProgressBlocks[$progressIndex] = array(
                'is_read_block' => false,
                'time' => 0,
                'percent' => 0,
            );
        } else {
            $updateProgressBlocks[$progressIndex] = $oldProgressBlock;
        }

        if ($newProgressBlock['is_read_block']) {
            $updateProgressBlocks[$progressIndex]['is_read_block'] = 1;
        }

        // max time
        if ($oldProgressBlock['time'] < $newProgressBlock['time']) {
            $updateProgressBlocks[$progressIndex]['time'] = $newProgressBlock['time'];
        }

        // max percent
        if ($oldProgressBlock['percent'] < $newProgressBlock['percent']) {
            $updateProgressBlocks[$progressIndex]['percent'] = $newProgressBlock['percent'];
        }
    }

    $blockCount = count($updateProgressBlocks);
    $isReadBlockCount = 0;
    foreach ($updateProgressBlocks as $updateProgressBlock) {
        if ($updateProgressBlock['is_read_block']) {
            $isReadBlockCount++;
        }
    }
    $progressValue = $blockCount > 0 ? $isReadBlockCount / $blockCount : 0;

    /**
     * TODO : update progress_relations table
     */
    // DB::table('progress_relations')
    //     ->where(array('id' => $progressRelation->id))
    //     ->update(array(
    //         'progress_block_info' => json_encode(exportToBlockinfo($updateProgressBlocks)),
    //         'progress_values' => $progressValue,
    //         'start_at' => $startAt,
    //         'updated_at' => time(),
    //     ));

    $progressBlockInfo = json_encode(exportToBlockinfo($updateProgressBlocks));
    $query = "UPDATE kollus_progress_relations SET 
        progress_block_info='$progressBlockInfo', 
        progress_values = '$progressValue', 
        start_at = '$startAt', 
        updated_at = '$updatedAt' 
        WHERE id='$progressRelationId'";
    mysql_query($query) or die('Could not connect: ' . mysql_error());

    // tatal video progress_values

    // $query = "SELECT progress_values FROM kollus_progress_relations WHERE member_id='$member_id'";
    $query = "SELECT progress_values FROM kollus_progress_relations WHERE member_id='$member_id' AND learning_id='$learning_id'";
    $result = mysql_query($query) or die('Could not connect: ' . mysql_error());

    $result2 = mysql_query("SELECT uid FROM ks_class_list WHERE class_uid='1'") or die('Could not connect: ' . mysql_error());
    $num_row = mysql_num_rows($result2);

    $progress = 0;
    while ($row = mysql_fetch_row($result)) {
        $progress += $row[0];
    }
    $progress = intval(100 * ($progress / $num_row));
    $query = "UPDATE ks_learning SET 
        progress='$progress'
        WHERE userid='$clientUserId' AND class_uid='1'";
    mysql_query($query) or die('Could not connect: ' . mysql_error());
    
} else {
    echo "forbidden 404";
}
