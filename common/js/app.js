/*
$(function(){
    // react-native에 통신을 요청한다.
    $('#btnSend').on('click', function() {
        var option = {
            url: '/movie.json'
        }

        // "sendLocation"는 react-native에서 받는 메서드 이름입니다.
        window.webViewBridge.send('sendLocation', option, function(res) {
            
            //let jsonData = 
            
            let posx = JSON.stringify(res.data.latitude);
            let posy = JSON.stringify(res.data.longitude);
            
            let text = '<a href="'+ "http://i-web.kr/skins/blockContent/inc/map_test.php?posx="+ posx +"&posy=" + posy +'">go Map</a>;'; 
            
            $('#result').html( text ); // JSON.stringify(res)
            

            
            $('#mapLink').html(posx+" / "+posy);

        }, function(err) {
            console.error(err);
        })
    })

}());
*/