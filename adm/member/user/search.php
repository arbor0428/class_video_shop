<style>
    .searchBox .form-control {
        background-color: #fff;
        display: inline-block;
    }

    .searchBox .btn-icon-split .text {
        padding: 0.31rem 0.75rem;
    }
</style>

<div class='searchBox' style='width:100%;'>
    <div style="float:left;">

        <select name="f_mtype" id="f_mtype" class="form-control" onchange="searchChk()" style="width:70px;">
            <option value=''>전체</option>
            <option value='M' <? if ($f_mtype == 'M') echo 'selected'; ?>>회원</option>
            <option value='T' <? if ($f_mtype == 'T') echo 'selected'; ?>>강사</option>
            <option value='A' <? if ($f_mtype == 'A') echo 'selected'; ?>>관리자</option>
        </select>
        <select name="f_status" id="f_status" class="form-control" onchange="searchChk();" style="width:70px;">
            <option value=''>상태</option>
            <option value='1' <? if ($f_status == '1') echo 'selected'; ?>>정상</option>
            <option value='2' <? if ($f_status == '2') echo 'selected'; ?>>휴먼</option>
            <option value='3' <? if ($f_status == '3') echo 'selected'; ?>>탈퇴</option>
            <option value='4' <? if ($f_status == '4') echo 'selected'; ?>>정지</option>
        </select>
        <select name="f_level" id="f_level" class="form-control" onchange="searchChk();" style="width:100px;">
            <option value=''>검색</option>
            <option value='M' <? if ($f_level == 'M') echo 'selected'; ?>>아이디</option>
            <option value='T' <? if ($f_level == 'T') echo 'selected'; ?>>이름</option>
        </select>

        <!-- <input type="text" name="f_userid" class="form-control" value="<?= $f_userid ?>" style='width:140px;' placeholder='아이디'onkeypress="if(event.keyCode==13){searchChk();}"> -->
        <input type="text" name="f_name" class="form-control" value="<?= $f_name ?>" style='width:180px;' placeholder='' onkeypress="if(event.keyCode==13) searchChk();">
        <a href="javascript:searchChk();" class="btn btn-secondary btn-icon-split" style="margin-top:-2px;">
            <span class="text">검색</span>
        </a>
    </div>

    <div style="float:right;">
        <select name="f_sort" id="f_sort" class="form-control" style='width:150px;' onchange='searchChk();'>
            <option value='rTime' <? if ($f_sort == 'rTime') echo 'selected'; ?>>가입일순</option>
            <option value='loginTime' <? if ($f_sort == 'loginTime') echo 'selected'; ?>>최근접속일순</option>
        </select>
    </div>
</div>