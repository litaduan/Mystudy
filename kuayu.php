<script>
	//原生
	var s = document.creatElement('script');
	s.type = 'text/javascript';
	s.url = 'http://yuming.com?p=v&callback=func';
	document.head.appendChild(s);

	function func(res){
		consle.log(JSON.stringify(res));
	}

	//jsonp
	$.ajax({
		url:"http://yuming.com",
		type:'get',
		data:{p:v},
		datatype:'jsonp',
		jsonpCallback:'func'//回调方法
	})
</script>
