<div>
	<h5>SharTheValue!</h5>
	<style>
		.type_div a{
			text-align: center;
			display:inline-block;
			width:140px;
			color:#666;

		}
		.type_div a.active{
			font-weight:bold;
			color:#000;
		}
		.signs_zone{
		display:flex;
		justify-content: space-between;
		flex-wrap: wrap;
	}
	.signs_zone > div{
		width:30%;

	}
	</style>
	<div class="type_div" style="width:100%; display:flex; justify-content: center; margin-bottom:3em;">
		<a href="/?type=campaign" @if(!$type || $type == 'campaign') class="active" @endif>캠페인</a>
		<a href="/?type=picture" @if($type == 'picture') class="active" @endif>활동중인 사람들</a>
	</div>
	<div style="display:flex; width:80%; margin:0 auto; justify-content: space-around;">
		@if(!$type || $type == 'campaign')
		@foreach ($campaigns as $campaign)
		<div class="cam_child" style="width:300px; height:300px; background-image:url({{$campaign->prev_image}}); background-size:cover; background-position:center; border-radius:20px; position:relative;" onclick="location.href='/campaign/view/{{$campaign->id}}';">
			<div style="position:absolute; right:10px; top:10px; color:#fff;">신고하기</div>
		</div>
		@endforeach
		@else
		<div class="cam_frame" style="width:100%; margin:2em auto; display:flex; justify-content: space-between; ">
	
	<div class="signs_zone" >
		@foreach($pictures as $sign)
		<div>
			<div  style="height:300px; background-image:url({{$sign['picture_url']}}); background-size:cover; background-position:center; border-radius:30px; padding:20px;">
				@php if ($sign['profile_url']) $p_url = $sign['profile_url']; else $p_url = '/assets/images/profile/header_no_profile.png' @endphp
				<div style="display: flex;align-items: center;">
					<a href="#" style="background-image: url({{ $p_url }}); width: 50px;    height: 50px;    display: inline-block;    border: 1px solid #333; border-radius:100%; background-position:center; background-size:cover; margin-right:10px;" ></a>
					<div style="display:inline-block;">
						<span style="color:#fff;">{{$sign['nickname']}}</span>
					</div>
				</div>
			</div>
			<div>{{$sign['picture_contents']}}</div>
		</div>
		@endforeach
	</div>
</div>
		@endif
	</div>
	<div class="pop_frame">
	 <div class="login_frame">
	<form method="post" action="/user/login">
		@csrf
		<input type="text" name="login_id" placeholder="아이디(E-mail)를 입력해주세요."><br>
		<input type="password" name="login_pw" placeholder="비밀번호를 입력해주세요."><br>
		<a href="/user/join">회원가입</a>
	<a href="/user/pass_find">비밀번호 찾기</a><br>
	<button>로그인</button>
	</form>
	<br>
	 <button type="button"  onclick="location.href='/user/login_kakao'">카카오톡</button><br>
	 <button type="button"  onclick="location.href='/user/login_naver'">네이버</button><br>
	 <button type="button"  onclick="location.href='/user/login_face'">페이스북</button><br>
	 <button type="button"  onclick="location.href='/google/login'">구글</button>
	
</div>
</div>
<style>
.pop_frame{
	width:100%;
	height:100vh;
	background:rgba(0,0,0,0.8);
	z-index: 1;
	position: absolute;
	top:0;
	left:0;
	display:none;
}
.login_frame{
	background:#fff;
	width:400px;
	top:25vh;
	left:calc(50% - 200px);
	position: absolute;
	padding:20px;
}
</style>
	<script>
	@php if(!session()->get('id')){ @endphp 
		setTimeout(function(){ $('.pop_frame').show();},15000);
	@php } @endphp

	$(window).scroll(function() {
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();
	if (Math.ceil((scrollHeight - scrollPosition) / scrollHeight) < 1) {
		@if($type == 'picture')
			var now_cnt = $('.signs_zone > div').length;
		@else
			var now_cnt = $('.cam_child').length;
		@endif
		
		console.log(now_cnt);
		$.ajax({
            url: "/api/picture/load",
            type: "POST",
            dataType: "json",
            beforeSend : function(xhr){
                xhr.setRequestHeader("Accept", "application/json");
                xhr.setRequestHeader("Authorization", "Bearer {{ $token }}");
            },
            data: {
                now_cnt: now_cnt   
            },
            success: function (result) {
                 console.log(result);
            },
            error: function (result) {
                alert("@lang('messages.fail')");
                return false;
            }
        });
	} 
});
	</script>