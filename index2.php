<script>
	//判断是否是安卓手机还是苹果手机
	function checkPlatform(){
		if(/android/i.test(navigator.userAgent)){
		$("#image_file").attr('accept','image/*');
		}
	}
	$(document).ready(function(){
		checkPlatform();
	});
</script>



Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36
