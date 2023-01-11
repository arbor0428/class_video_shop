<?
include 'header.php';
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable mt-3' style='margin:15px 0;'>
		<tr>
			<th>충전금액</th>
			<td>
				<input type="text" name="amount" id="amount" class="form-control" placeholder="amount" value="10000">
			</td>
		</tr>
		<tr>
			<th>결제수단</th>
			<td>
				<div class="point-pay">
					<div><label><input type="radio" name="method" value="카드" checked /> 신용카드</label></div>
					<div><label class="mb-0"><input type="radio" name="method" value="계좌이체" /> 계좌이체</label></div>
				</div>
			</td>
		</tr>
		<tr>
			<th>정보</th>
			<td>
				<div class="input-wrap mb-2"><input type="text" name="customerName" id="customerName" class="form-control" placeholder="이름(선택)" value="<?= $row['name'] ?>"></div>
				<div class="input-wrap"><input type="text" name="customerEmail" id="customerEmail" class="form-control" placeholder="이메일(선택)"></div>
			</td>
		</tr>
		<tr>
			<td class="text-center border-bottom-0 pt-4" colspan="2">
				<div class="point-pay">
					<a href="javascript:tosspay()" class="btn btn-lg btn-primary btn-icon-split">
						<span class="text">결제하기</span>
					</a>
				</div>
			</td>
		</tr>
	</table>

	<script src="https://js.tosspayments.com/v1/payment"></script>
	<script>
		const clientKey = 'test_ck_5mBZ1gQ4YVXKaKLdWAX3l2KPoqNb';
		const tossPayments = TossPayments(clientKey) // 클라이언트 키로 초기화하기

		const pointAdd = function(num) {
			let amount = parseInt($('#amount').val().replace(/,/g, ''))
			amount += num
			if (amount > 1000000) {
				// alert('최대 금액을 초과하였습니다')
				$('#amount').addClass('input-point-warning')
				$('.point-warning-max').show()
				$('.point-warning-min').hide()
			} else {
				// amount.toLocaleString('ko-KR')
				// amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				$('#amount').removeClass('input-point-warning')
				$('.point-warning-max').hide()
				$('.point-warning-min').hide()
				$('#amount').val(amount.toLocaleString('ko-KR') + '   P')
			}
		}

		const pointReset = function() {
			$('#amount').val('0   P');
		}

		const payment = function() {
			$('.email-warning').hide();
			const amount = parseInt(document.getElementById('amount').value.replace(',', '').replace('   P', ''));
			if (amount === 0 || amount === "" || isNaN(amount)) {
				$('#amount').addClass('input-point-warning');
				$('.point-warning-max').hide();
				$('.point-warning-min').show();
				// alert('금액을 입력해주세요')
				// console.log('입력 금액 :', amount);
				return;
			}
			const method = $('input[name=method]:checked').val();
			const customerEmail = $('input[name=customerEmail]').val()
			// console.log(method);
			// console.log(customerEmail);
			const paymentData = {
				amount: amount,
				orderId: new Date().getTime(),
				orderName: "포인트 충전",
				customerName: "<?= $row['name'] ?>",
				customerEmail: customerEmail,
				successUrl: window.location.origin + "/adm/pointPay/success.php",
				failUrl: window.location.origin + "/adm/pointPay/fail.php",
			}
			tossPayments.requestPayment(method, paymentData)
				.catch(function(error) {
					if (error.code === 'USER_CANCEL') {
						// 결제 고객이 결제창을 닫았을 때 에러 처리
						console.log('결제가 취소되었습니다')
					} else if (error.code === 'INVALID_CARD_COMPANY') {
						// 유효하지 않은 카드 코드에 대한 에러 처리
						console.log('유효하지 않은 카드 입니다')
					} else if (error.code === "INVALID_EMAIL") {
						$('.email-warning').show();
						$('input[name=customerEmail]').focus();
					}
				})
		}

		$(() => {

		})
	</script>
</div>
<?
include 'footer.php';
?>