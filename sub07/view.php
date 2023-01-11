<?
	include '../header.php';
?>

<div class="subWrap">
   <div class="s_center dp_sb">
        <div class="detail_cont">
            <div class="detail_sum dp_sb">
                <div class='bx'>
                    <div style="width:665px; height:450px; background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></div>
                    <div style="width:665px; height:450px; background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></div>
                    <div style="width:665px; height:450px; background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></div>
                    <div style="width:665px; height:450px; background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></div>
                </div>
                
                <div id="bx-pager">
                    <a data-slide-index="0" href="" style="background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></a>
                    <a data-slide-index="0" href="" style="background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></a>
                    <a data-slide-index="0" href="" style="background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></a>
                    <a data-slide-index="0" href="" style="background:url('/images/sub/store_sumnail.png') center center no-repeat; background-size:cover;"></a>
                </div>
            </div>
            <div class="event_detail">
                <img src="/images/sub/store_detail_sample.png" alt="상세보기">
            </div>
        </div>
        <div class="detail_right">
            <div class="pin_box">
                <p class="pin_box_tit bold2">EMS 어깨 마사지기기</p>
                <p class="pin_box_det">NASA가 무중력 상태의 우주인 운동을 위해 만든 최첨단 건강의료가전 어깨 저주파 마사지기기</p>
            
                <a class="pin_box_btn dp_f dp_c dp_cc bold2 c_bora01 border" href="" title="">장바구니</a>
                <a class="pin_box_btn dp_f dp_c dp_cc bora01 c_w bold2" href="" title="">구매하기</a>
            </div>
        </div>
   </div>
</div>


<script>
    $(document).ready(function () {
        $(".bx").bxSlider({
            mode: 'horizontal',	
            speed: '300',
            pause: '3000',
            pagerCustom: '#bx-pager',
            auto: false
        });
    });
</script>
<style>
    .bx-wrapper {
        width: 665px;
        margin-bottom: 30px;
        box-shadow: none;
        border: none;
    }
    .bx-wrapper .bx-next {
        right: 0px;
        background-image:url("../images/sub/order_next.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 13px 21px;
    }
    .bx-wrapper .bx-prev {
        left: 0px;
        background-image:url("../images/sub/order_prev.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 13px 21px;
    }
    .bx-wrapper .bx-prev:hover,
    .bx-wrapper .bx-prev:focus {
    background-position: center center;
    }
    .bx-wrapper .bx-next:hover,
    .bx-wrapper .bx-next:focus {
    background-position: center center;
    }
    .bx-wrapper .bx-controls-direction a {
        top: 115%;
    }

    #bx-pager a {
        margin-bottom: 17px;
        display: block;
        border-radius: 4px;
        width: 120px; 
        height: 100px;
        overflow: hidden;
    }
    #bx-pager a:last-child {
        margin-bottom: 0;
    }

</style>


<?
	include '../footer.php';
?>