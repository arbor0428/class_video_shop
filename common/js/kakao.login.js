// 사용할 앱의 JavaScript 키를 설정해 주세요.
Kakao.init('50e2098ced5c1ea98586f477c4806258');
// 카카오 로그인 버튼을 생성합니다.
function loginWithKakao() {
  // 로그인 창을 띄웁니다.
  document.location.href="https://kauth.kakao.com/oauth/authorize?client_id=e5194d3f5a9941f8be97b02a8e556392&redirect_uri=http://epcm.co.kr/sns_login/kakao_login/kakao_Auth&response_type=code";
};