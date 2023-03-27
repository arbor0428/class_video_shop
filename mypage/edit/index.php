<?php
include '../../header.php';
$side_menu = 14;
$topTxt01 = '개인정보 수정';

$sql = "SELECT * FROM ks_member WHERE userid='$GBL_USERID'";
$row = sqlRow($sql);

?>

<?
include '../location04.php';
?>

<form name="frm01" action="/module/login/edit_proc.php" method="post">
    <input type="hidden" name="type" />
    <input type="hidden" name="uid" />
    <div class="subWrap">
        <div class="s_center dp_sb">
            <?
            include '../sidemenu.php';
            ?>
            <div class="s_cont">
                <div class="s_cont_tit f20 bold2 c_bora01">
                    개인정보 수정
                    <span class="s_cont_tit_det f14 c_blk regular">* 필수 입력 정보입니다.</span>
                </div>
                <div class="personal_Info">
                    <p class="s_edit_tit f18 bold2 m_24">내 정보 수정</p>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">이메일<span class="mustInput">*</span></div>
                        <div class="personal_det"><?= $row['userid'] ?></div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">성 명<span class="mustInput">*</span></div>
                        <div class="personal_det dp_f dp_c">
                            <div class="personal_det"><?= $row['name'] ?></div>
                            <!-- <input type="text" value="<?= $row['name'] ?>" style="color: #000;" readonly> -->
                        </div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">핸드폰<span class="mustInput">*</span></div>
                        <div class="personal_det">
                            <div class="m_block_shape dp_f dp_c">
                                <div class="personal_det"><?= $row['phone'] ?></div>
                                <!-- <input type="text" value="<?= $row['phone'] ?>" readonly> -->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="personal_row dp_f dp_c">
                        <div class="personal_tit">성 별</div>
                        <div class="personal_det dp_f dp_c">
                            남자
                        </div>
                    </div> -->
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">기존비밀번호<span class="mustInput">*</span></div>
                        <div class="personal_det">
                            <div class="m_block_shape dp_f dp_c">
                                <input type="password" name="pwd" placeholder="기존비밀번호">
                            </div>
                        </div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">비밀번호<span class="mustInput">*</span></div>
                        <div class="personal_det">
                            <div class="m_block_shape dp_f dp_c">
                                <input type="password" name="pwdNew" placeholder="변경시 입력">
                                <span class="f14 c_gry05 s_label">영문, 숫자 또는 영문+숫자를 조합하여 4~10자리까지 가능합니다.</span>
                            </div>
                        </div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">비밀번호 확인<span class="mustInput">*</span></div>
                        <div class="personal_det dp_f dp_c">
                            <input type="password" name="pwdChk" placeholder="변경시 입력">
                        </div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">직 업</div>
                        <div class="personal_det dp_f dp_c">
                            <select name="option01" id="option01">
                                <option value="" <? if ($row['option01'] == "") echo "selected"; ?>>직업을 선택해주세요.</option>
                                <option value="회사원" <? if ($row['option01'] == "회사원") echo "selected"; ?>>회사원</option>
                                <option value="대학생" <? if ($row['option01'] == "대학생") echo "selected"; ?>>대학생</option>
                                <option value="현업 필라테스 강사" <? if ($row['option01'] == "현업 필라테스 강사") echo "selected"; ?>>현업 필라테스 강사</option>
                                <option value="현업 트레이너" <? if ($row['option01'] == "현업 트레이너") echo "selected"; ?>>현업 트레이너</option>
                                <option value="물리치료사" <? if ($row['option01'] == "물리치료사") echo "selected"; ?>>물리치료사</option>
                                <option value="필라테스 강사 준비중" <? if ($row['option01'] == "필라테스 강사 준비중") echo "selected"; ?>>필라테스 강사 준비중</option>
                                <option value="스포츠지도사 자격증 준비" <? if ($row['option01'] == "스포츠지도사 자격증 준비") echo "selected"; ?>>스포츠지도사 자격증 준비</option>
                                <option value="트레이너 준비중" <? if ($row['option01'] == "트레이너 준비중") echo "selected"; ?>>트레이너 준비중</option>
                                <option value="운동지도자 준비중" <? if ($row['option01'] == "운동지도자 준비중") echo "selected"; ?>>운동지도자 준비중</option>
                                <option value="기타" <? if ($row['option01'] == "기타") echo "selected"; ?>>기타</option>
                            </select>
                        </div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">관심분야</div>
                        <div class="personal_det">
                            <div class="interest_radio_wrap dp_f dp_c">
                                <label for="interest01">
                                    <input type="radio" value="운동" name="option02" <? if ($row['option02'] == "운동") echo "checked"; ?>>
                                    운동
                                </label>
                                <label for="interest02">
                                    <input type="radio" value="도수" name="option02" <? if ($row['option02'] == "도수") echo "checked"; ?>>
                                    도수
                                </label>
                                <label for="interest03">
                                    <input type="radio" value="필라테스" name="option02" <? if ($row['option02'] == "필라테스") echo "checked"; ?>>
                                    필라테스
                                </label>
                                <label for="interest04">
                                    <input type="radio" value="골프" name="option02" <? if ($row['option02'] == "골프") echo "checked"; ?>>
                                    골프
                                </label>
                                <label for="interest05">
                                    <input type="radio" value="기타" name="option02" <? if ($row['option02'] == "기타") echo "checked"; ?>>
                                    기타
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">가입경로</div>
                        <div class="personal_det">
                            <div class="interest_radio_wrap dp_f dp_c">
                                <label for="join_way01">
                                    <input type="radio" value="검색" name="option03" <? if ($row['option03'] == "검색") echo "checked"; ?>>
                                    검색
                                </label>
                                <label for="join_way02">
                                    <input type="radio" value="SNS" name="option03" <? if ($row['option03'] == "SNS") echo "checked"; ?>>
                                    SNS
                                </label>
                                <label for="join_way03">
                                    <input type="radio" value="카페" name="option03" <? if ($row['option03'] == "카페") echo "checked"; ?>>
                                    카페
                                </label>
                                <label for="join_way04">
                                    <input type="radio" value="블로그" name="option03" <? if ($row['option03'] == "블로그") echo "checked"; ?>>
                                    블로그
                                </label>
                                <label for="join_way05">
                                    <input type="radio" value="기타" name="option03" <? if ($row['option03'] == "기타") echo "checked"; ?>>
                                    기타
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="personal_row dp_f dp_c">
                        <div class="personal_tit dp_f">마켓팅 동의</div>
                        <div class="personal_det">
                            <div class="personal_det dp_f dp_c">
                                <input type="checkbox" name="receiveChk" id="receiveChk" <? if ($row['receiveChk'] == "1") echo "checked"; ?>>
                                <span class="f12"> 문자 메세지 정보수신 동의(서비스 안내, 이벤트 등의 정보)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="addr_Info m-60">
                    <div class="dp_sb dp_c dp_end m_10">
                        <p class="s_edit_tit f18 bold2">배송지 수정</p>
                        <a class="c_bora01 f12 bold2 newAddrBtn" href="javascript:void(0)" title="">신규 배송지 추가&nbsp;&nbsp;+</a>
                    </div>
                    <!--배송지 수정 list pc-->
                    <div class="tableWrap pc_addrTbl_wrap">
                        <table class="subTbl addSubtbl addrTbl">
                            <tbody>
                                <tr class="brb000">
                                    <th>배송지</th>
                                    <th>이름</th>
                                    <th>주소</th>
                                    <th>연락처</th>
                                    <th>수정/삭제</th>
                                </tr>
                                <?
                                $addr_arr = sqlArray("SELECT * FROM ks_address WHERE userid='$GBL_USERID'");
                                foreach ($addr_arr as $addr) {
                                ?>
                                    <tr class="addr_tr_det">
                                        <td>
                                            <? if ($addr['default_addr'] == 1) echo '<div class="bora01 c_w default_label f12 dp_f dp_c dp_cc">기본 배송지</div>' ?>
                                            <span class="bold2"><?= $addr['title'] ?></span>
                                        </td>
                                        <td><?= $addr['name'] ?></td>
                                        <td>(<?= $addr['zipcode'] ?>) <?= $addr['addr01'] ?> <?= $addr['addr02'] ?></td>
                                        <td><?= $addr['phone'] ?></td>
                                        <td>
                                            <div class="addrEditBtnWrap dp_f dp_c dp_cc">
                                                <a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="javascript:void(0)" onclick="reg_edit(<?= $addr['uid'] ?>)" title="수정">수정</a>
                                                <!-- <a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="javascript:void(0)" onclick="reg_edit()" title="수정">기본배송지로</a> -->
                                                <a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="javascript:void(0)" onclick="reg_del(<?= $addr['uid'] ?>)" title="삭제">삭제</a>
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                                <!-- <tr class="addr_tr_det">
                                    <td>
                                        <span class="bold2">에듀핌</span>
                                    </td>
                                    <td>에듀핌</td>
                                    <td>서울 마포구 매봉산로 37 (상암동, DMC 산학협력연구센터) 605호</td>
                                    <td>010-1234-5678</td>
                                    <td>
                                        <div class="addrEditBtnWrap dp_f dp_c dp_cc">
                                            <a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="" title="수정">수정</a>
                                            <a class="addrEditBtn c_gry04 f14 dp_f dp_c" href="" title="수정">삭제</a>
                                        </div>
                                    </td>
                                </tr> -->

                            </tbody>
                        </table>
                    </div>

                    <!--배송지 수정 list mobile-->
                    <div class="m_addrTbl_wrap">
                        <div class="m_addrTbl_box">
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">배송지</div>
                                <div class="row_det dp_f dp_c">
                                    <div class="bora01 c_w default_label f12 dp_f dp_c dp_cc">기본 배송지</div>
                                    <span class="bold2">에듀핌</span>
                                </div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">이름</div>
                                <div class="row_det">에듀핌</div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">주소</div>
                                <div class="row_det">서울 마포구 매봉산로 37 (상암동, DMC 산학협력연구센터) 605호
                                </div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">연락처</div>
                                <div class="row_det">010-1234-5678</div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">수정/삭제</div>
                                <div class="row_det">
                                    <div class="addrEditBtnWrap dp_f dp_c">
                                        <a class="addrEditBtn c_w bora01 f14 dp_f dp_c" href="" title="수정">수정</a>
                                        <a class="addrEditBtn c_w bora01 f14 dp_f dp_c" href="" title="수정">삭제</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m_addrTbl_box">
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">배송지</div>
                                <div class="row_det">
                                    <span class="bold2">에듀핌</span>
                                </div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">이름</div>
                                <div class="row_det">에듀핌</div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">주소</div>
                                <div class="row_det">서울 마포구 매봉산로 37 (상암동, DMC 산학협력연구센터) 605호
                                </div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">연락처</div>
                                <div class="row_det">010-1234-5678</div>
                            </div>
                            <div class="m_addrTbl_row dp_f dp_c">
                                <div class="row_tit">수정/삭제</div>
                                <div class="row_det">
                                    <div class="addrEditBtnWrap dp_f dp_c">
                                        <a class="addrEditBtn c_w bora01 f14 dp_f dp_c" href="" title="수정">수정</a>
                                        <a class="addrEditBtn c_w bora01 f14 dp_f dp_c" href="" title="수정">삭제</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="twoBtn02Wrap dp_f dp_c dp_cc">
                    <a class="dp_f dp_c dp_cc bold2" href="javascript:void(0)" title="탈퇴신청">탈퇴신청</a>
                    <a class="dp_f dp_c dp_cc bora01 c_w" href="javascript:void(0)" onclick="member_edit()" title="정보수정">정보수정</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const member_edit = function() {
        const form = document.frm01

        const pwdNew = form.pwdNew.value;
        const pwdChk = form.pwdChk.value;

        if (isFrmEmptyModal(form.pwd, "비밀번호를 입력하세요.")) return;

        if (pwdNew != '' || pwdChk != '') {
            if (pwdNew != pwdChk) {
                GblMsgBox("비밀번호가 일치하지 않습니다")
                form.pwdChk.focus()
                return
            }
        }

        form.target = 'ifra_gbl'
        form.submit()
    }

    function tema(t) {
        $('#addrRegisterFrame').html("<iframe src='../addrRegister.php?uid=" + t + "' name='' style='width:100%;height:600px;' frameborder='0' scrolling='auto'></iframe>");
        $('.addrRegister_open').click();
    }

    $(".newAddrBtn").click(function(event) {
        tid = $(this).data('tid');
        tema(tid);
        event.preventDefault();
    });

    /*수정버튼 시 팝업 open*/

    function reg_edit(uid) {
        tema(uid);
        form = document.FRM;
        event.preventDefault();

    }

    function reg_del(uid) {
        form = document.frm01;
        let result = confirm('삭제하시겠습니까?');

        if (result == true) {
            form.type.value = 'del';
            form.uid.value = uid;
            form.action = '../proc.php';
            form.submit();
        } else {
            alert('취소');
        }

    }
</script>

<?
include '../../footer.php';
?>