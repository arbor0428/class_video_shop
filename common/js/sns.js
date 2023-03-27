$(function() {
    $(".share-facebook").click(function() {
        window.open($(this).attr("href"), "win_facebook", "menubar=1,resizable=1,width=600,height=400");
        return false;
    });

    $(".share-twitter").click(function() {
        window.open($(this).attr("href"), "win_twitter", "menubar=1,resizable=1,width=600,height=350");
        return false;
    });

    $(".share-googleplus").click(function() {
        window.open($(this).attr("href"), "win_googleplus", "menubar=1,resizable=1,width=600,height=600");
        return false;
    });
});

function sharetwitter(url,txt){
	window.open("https://twitter.com/intent/tweet?text="+encodeURIComponent(txt)+"&url="+url, "win_twitter", "menubar=1,resizable=1,width=600,height=350");
    return false;
}

function sharefacebook(url){
	window.open("http://www.facebook.com/sharer/sharer.php?u="+url, "win_facebook", "menubar=1,resizable=1,width=600,height=400");
    return false;
}

function sharegoogleplus(url){
	window.open("https://plus.google.com/share?url="+url, "win_googleplus", "menubar=1,resizable=1,width=600,height=600");
    return false;
}

function shareline(url,txt){
	window.open("http://line.me/R/msg/text/?"+txt+" "+url, "win_twitter", "menubar=1,resizable=1,width=600,height=350");
    return false;
}

function sharetalk(title,url,txt,img)
{
	Kakao.init('7fe60855cdd4c06b036620f60b7f642b');
	Kakao.Link.sendTalkLink({
      label: title,
	  webLink: {
			text: txt,
			url: url
	  },
	  image: {
			src: img,
			width: '520',
			height: '400'
		}
    });
	
}

function sharestory(url,txt) {
	Kakao.Story.share({
	  url: url,
	  text: txt
	});
}

function shareband(url,txt){
	window.open("http://band.us/plugin/share?body="+txt+"&route="+url, "share_band", "width=410, height=540, resizable=no");
	return false;
}

function sharenaver(url,txt){
	window.open("http://share.naver.com/web/shareView.nhn?url=" + url + "&title=" + txt, "share_band", "width=410, height=540, resizable=no");
	return false;
	
}
