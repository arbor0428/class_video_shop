<?
/*
$HOLIDAY = array();

if ($sRange == '')	$sRange = 5;
if ($eRange == '')	$eRange = 5;

$sYear = date('Y') - $sRange;
$eYear = date('Y') + $eRange;

//$yearRange = 'c-'.$sRange.':c+'.$eRange;
$yearRange = $sYear . ':' . $eYear;

//휴일정의
include '/home/workgroup/www/module/class/class.Holiday.php';
$HOLIDAY = Holiday($sYear, $eYear);
*/
?>

<link href="/module/datepicker/bootstrap-datepicker3.standalone.css" rel="stylesheet">
<script src="/module/datepicker/bootstrap-datepicker.js"></script>
<script src="/module/datepicker/bootstrap-datepicker.ko.js"></script>

<style>
	.fpicker {
		background: url('/module/datepicker/cals.jpg') no-repeat;
		background-color: #fff !important;
		background-position: calc(100% - 5px) center;
		cursor: pointer;
		display: inline;
		width: 20%;
		cursor: pointer;
	}


	.fpickerafter {
		width: 20%;
	}

	.table-condensed th,
	.table-condensed td {
		font-size: 14px;
		font-family: 'Malgun gothic', dotum, sans-serif;
	}

	.table-condensed td.date-saturday {
		color: #4e73df !important;
	}

	.table-condensed td.date-sunday,
	.table-condensed td.holiday {
		color: #e74a3b !important;
	}

	.table-condensed td.old,
	.table-condensed td.new {
		color: #d6d6d6 !important;
	}

	.datepicker .prev,
	.datepicker .next {
		font-size: 24px !important;
	}
</style>

<script>
	$(document).ready(function() {
		$('.fpicker').prop('readonly', true);
	});

	$(function() {
		holidays = new Array();
		<?
		foreach ($HOLIDAY as $k => $v) {
		?>
			holidays["<?= $k ?>"] = "<?= $v ?>";
		<?
		}
		?>

		$('.fpicker').datepicker({
			format: "yyyy-mm-dd", //데이터 포맷 형식(yyyy : 년 mm : 월 dd : 일 )
			startDate: '', //달력에서 선택 할 수 있는 가장 빠른 날짜. 이전으로는 선택 불가능 ( d : 일 m : 달 y : 년 w : 주)
			endDate: '', //달력에서 선택 할 수 있는 가장 느린 날짜. 이후로 선택 불가 ( d : 일 m : 달 y : 년 w : 주)
			autoclose: true, //사용자가 날짜를 클릭하면 자동 캘린더가 닫히는 옵션
			calendarWeeks: false, //캘린더 옆에 몇 주차인지 보여주는 옵션 기본값 false 보여주려면 true
			clearBtn: false, //날짜 선택한 값 초기화 해주는 버튼 보여주는 옵션 기본값 false 보여주려면 true
			datesDisabled: [], //선택 불가능한 일 설정 하는 배열 위에 있는 format 과 형식이 같아야함.
			daysOfWeekDisabled: [], //선택 불가능한 요일 설정 0 : 일요일 ~ 6 : 토요일
			daysOfWeekHighlighted: [], //강조 되어야 하는 요일 설정
			disableTouchKeyboard: false, //모바일에서 플러그인 작동 여부 기본값 false 가 작동 true가 작동 안함.
			immediateUpdates: false, //사용자가 보는 화면으로 바로바로 날짜를 변경할지 여부 기본값 :false 
			multidate: false, //여러 날짜 선택할 수 있게 하는 옵션 기본값 :false 
			multidateSeparator: ",", //여러 날짜를 선택했을 때 사이에 나타나는 글짜 2019-05-01,2019-06-01
			templates: {
				leftArrow: '&laquo;',
				rightArrow: '&raquo;'
			}, //다음달 이전달로 넘어가는 화살표 모양 커스텀 마이징 
			showWeekDays: true, // 위에 요일 보여주는 옵션 기본값 : true
			title: "", //캘린더 상단에 보여주는 타이틀
			todayHighlight: true, //오늘 날짜에 하이라이팅 기능 기본값 :false 
			toggleActive: true, //이미 선택된 날짜 선택하면 기본값 : false인경우 그대로 유지 true인 경우 날짜 삭제
			weekStart: 0, //달력 시작 요일 선택하는 것 기본값은 0인 일요일 
			language: "ko", //달력의 언어 선택, 그에 맞는 js로 교체해줘야한다.
			beforeShowDay: function(dateTxt) {
				yy = dateTxt.getFullYear();
				mm = dateTxt.getMonth() + 1;
				dd = dateTxt.getDate();

				day = yy + (("00" + mm.toString()).slice(-2)) + (("00" + dd.toString()).slice(-2));

				holiday = holidays[day];

				// exist holiday?
				if (holiday) {
					return {
						tooltip: holiday,
						classes: 'holiday'
					};

				} else {
					switch (dateTxt.getDay()) {
						case 0: // is sunday?
							return {
								classes: 'date-sunday'
							};

						case 6: // is saturday?
							return {
								classes: 'date-saturday'
							};
					}
				}
			}


		}); //datepicker end
	}); //ready end
</script>