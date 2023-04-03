<?
include "/home/edufim/www/module/login/head.php";

$query = "SELECT l.userid, l.sDate, l.eDate, m.name, (SELECT name FROM ks_member WHERE ks_member.uid=c.tuid) tname, c.title, c.period, o.rDate, o.amount
	FROM ks_learning l
	JOIN ks_member m ON l.userid=m.userid
	JOIN ks_class c ON l.class_uid=c.uid
	JOIN ks_order o ON l.order_no=o.order_no
	WHERE l.userid='$GBL_USERID' AND l.class_uid='$uid'";
$row = sqlRow($query);

// $tname = sqlRowOne("SELECT name FROM ks_member WHERE uid=" . $row['tuid']);

foreach ($row as $k => $v) {
	${$k} = $v;
}

// $eng_name = sqlRowOne("SELECT eng_name FROM ks_member WHERE userid='$GBL_USERID'");
// $eng_name = sqlRowOne("SELECT eng_name FROM ks_member WHERE userid='$GBL_USERID'");
// $rDate = sqlRowOne("SELECT rDate FROM ks_cert_completion WHERE userid='$GBL_USERID' AND class_uid='$uid'");
?>
<div class="classConfWrap">
	<div class="classConf_tit dp_f dp_c dp_cc f24 bold2">수강확인증</div>
	<div class="classConf_top_tbl_wrap">
		<table class="classConf_top_tbl wid100">
			<tbody>
				<tr>
					<th>성명</th>
					<td><?= $name ?> (<?= $userid ?>)</td>
				</tr>
				<tr>
					<th>결제일</th>
					<td><?= $rDate ?></td>
				</tr>
				<tr>
					<th>결제금액</th>
					<td><?= number_format($amount) ?> 원</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="classConf_bot">
		<p class="classConf_bot_tit">수강정보</p>
		<div class="classConf_bot_tbl_wrap">
			<table class="classConf_bot_tbl wid100">
				<tbody>
					<tr>
						<th>강사명</th>
						<td><?= $tname ?></td>
					</tr>
					<tr>
						<th>수강 과정</th>
						<td><?= $title ?></td>
					</tr>
					<tr>
						<th>수강 기간</th>
						<td><?= $sDate ?> ~ <?= $eDate ?> (<?= $period ?>일)</td>
					</tr>
					<tr>
						<th>강좌명</th>
						<td><?= $title ?></td>

							<!-- 운동생리학 / 이재석교수님
							기초해부학(수료증 과정) / 이우열교수님<br>
							암기해부학 / 우승훈교수님 <br>
							기구필라테스 베리에이션 / 에듀핌교수님<br>
							매트필라테스 베리에이션 / 에듀핌교수님<br>
							매트+소도구 트레이닝 / 이파마스터교수님<br>
							필라테스 개론 / 변은영교수님<br>
							체형교정 필라테스 프로그램 / 이서정교수님<br>
							ROM 관절가동범위 검사법 / 이찬우교수님<br>
							매트필라테스 티칭전략 / 김나현교수님<br>
							MMT 근력등급검사법 / 이찬우교수님<br>
							기능해부학 / 홍정기교수님<Br>
							운동손상관리전략 / 신승호교수님<br>
							의사 이고은의 임산부 필라테스 [산전편] / 이고은교수님<br>
							의사 이고은의 임산부 필라테스 [산후편] / 이고은교수님<br>
							척추측만 슈로스 접근법 / 이상길교수님<br>
							소메코 추천 메디컬동작 Top 10 / 이영진교수님<br>
							[2018] 하지교차증후군 T.R.A.T 접근법 워크샵 / 에듀핌교수님<br>
							[2019] 교정운동 스페셜리스트 워크샵 / 이찬우교수님<br>
							매트 필라테스 티칭 커뮤니케이션 전략 / 김나현교수님<br>
							소도구 시퀀스 옵저베이션 올 클래스 / 김나현교수님<br>
							매트 시퀀스 옵저베이션 올 클래스 / 김나현교수님<br>
							시그니처 리포머 시퀀스 옵저베이션 올 클래스 / 김나현교수님<br>
							시그니처 래더 바렐 시퀀스 옵저베이션 올 클래스 / 김나현교수님<br>
							시그니처 체어 시퀀스 옵저베이션 올 클래스 / 김나현교수님<br>
							시그니처 캐딜락 시퀀스 옵저베이션 올 클래스 / 변은영교수님<br>
							PMA-NCPT 합격공식 / 박상윤교수님<br>
							필라테스 강사를 위한 동작 티칭 가이드 200 / 변은영교수님<br>
							씨너 리너 스트롱거 / 차민기교수님<br>
							호주물리치료사의 13가지 체형교정법 / 장원석교수님<br>
							골프 피트니스 베이직 / 선종협교수님<br>
							바벨 운동 베이직 / 김재걸교수님<br>
							머스트무브 보행전문가과정 / 주상화교수님<br>
							트레이너 기초 운동생리학 / 문기범교수님<br>
							홍정기_근골격계 기능해부학(수료증과정) / 홍정기교수님<br>
							홍정기_근막 이론과 실전(수료증과정) / 홍정기교수님<br>
							홍정기_신경해부학(수료증과정) / 홍정기교수님<br>
							홍정기_근력운동 트레이닝론(수료증과정) / 홍정기교수님<br>
							홍정기_자세평가 이론과 실전(수료증과정) / 홍정기교수님<br>
							홍정기_관절운동학(수료증과정) / 홍정기교수님<br>
							홍정기_모토컨트롤 실전(수료증과정) / 홍정기교수님<br>
							홍정기_기능성운동 평가와 실전(수료증과정) / 홍정기교수님<br>
							홍정기_움직임 손상증후군(수료증과정) / 홍정기교수님<br>
							패스 추가 강의 1 / 에듀핌교수님<br>
							패스 추가 강의 2 / 에듀핌교수님<br>
							패스 추가 강의 3 / 에듀핌교수님 <br>
							패스 추가 강의 4 / 에듀핌교수님<br>
							패스 추가 강의 5 / 에듀핌교수님<br>
							패스 추가 강의 6 / 에듀핌교수님 <Br>
							클래식 필라테스 / CPK교수님 <br>
							일자목, 거북목 개선 운동 솔루션 VOD / 홍정기교수님 <br>
							첫 고객을 사로잡는 클래식 필라테스 매트 1:1 티칭전략 [VOD] / CPK교수님<br>
							상급자동작 단계별 시퀀스 / 변은영교수님 <br>
							감각 고강도 시퀀스 / 권가희교수님<br>
							홍정기_스타팅 스트렝스(수료증과정) / 홍정기교수님 <br>
							홍정기_NSCA 퍼스널 트레이닝의 정수(수료증과정) / 홍정기교수님 <br>
							홍정기_움직임(수료증과정) / 홍정기교수님 <br>
							홍정기_근골격계 이론과 재활운동(수료증과정) / 홍정기교수님 <Br>
							홍정기_임상 정형의학 검사(수료증과정) / 홍정기교수님 <br>
							프리미엄 레슨을 위한 바디워크 세미나 - 호흡&상지(어깨, 팔꿈치) / 홍정기교수님 <br>
							[2022] 척추측만 슈로스 오픈 세미나 / 이상길교수님 <br>
							실전 선수 트레이닝 이론 / 이동호교수님 <br>
							골프 필라테스 / 변은영교수님 <br>
							김나현의 캐딜락 시퀀스 ALL 클래스 / 김나현교수님<br>
							홍정기_근육불균형 평가와 솔루션-얀다(수료증과정) / 홍정기교수님 -->
					</tr>
				</tbody>
			</table>
			<p class="tbl_notice">* 결제 금액에는 교재 금액이 포함되어 있습니다. (교재를 함께 구매한 경우)</p>
		</div>
		<div class="classConf_signWrap">
			<p class="classConf_sign_tit f24 c_gry04 txt-c">위 사항이 사실임을 증명합니다.</p>
			<p class="classConf_sign_date f22 bold2 txt-c"><?= date('Y년 m월 d일') ?></p>
			<!-- <p class="classConf_sign_date f22 bold2 txt-c">2022년 10월 11일</p> -->
			<div class="classConf_sign_cir dp_f dp_c dp_cc">
				<img class="stamp" src="/images/stamp.jpg">
				<!-- 에듀핌<br>
				도장 -->
			</div>
		</div>
		<div class="classConf_addrwrap txt-c">
			<img src="/images/classConfirm_logo.svg" alt="">
			<ul class="classConf_addr dp_f dp_c dp_cc f14">
				<li class="dp_f dp_c dp_cc">주식회사 에듀핌</li>
				<li class="dp_f dp_c dp_cc">사업자등록번호 : 640-86-02251</li>
				<li class="dp_f dp_c dp_cc">Tel : 010-3968-9609</li>
			</ul>
			<p class="classConf_addr02 txt-c f14">경기도 고양시 덕양구 중앙로 442, 4층 402호(행신동, 아성프라자)</p>
		</div>
	</div>
</div>

<script language='javascript'>
	function printPage() {
		if (window.print) {
			agree = confirm('현재 페이지를 출력하시겠습니까?');
			if (agree) window.print();
		}
	}
	$('.printBtn').on('click', function(){
		printPage()
	})
	setTimeout('printPage();', 100);
</script>