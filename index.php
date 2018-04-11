html：

<canvas class="i-img1" id="i-img1" width="550px" height="460px"></canvas>

<div class="b2-3"><input class="i-input1" id="i-input1" type="file" accept="image/*" /></div>



css：

.i-img1{margin: 316px 0 0 38px; border: 2px solid black;}

.b2-3{margin: 304px 0 0 7px;background: url("") no-repeat center center; width: 141px;height: 41px;}




js:

var  picture_src;

 //从相册选择照片
    $('.i-input1').change(function(){
        //判断安卓苹果手机
	var u = navigator.userAgent;
	var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
        var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
        //图片方向角 added by lzk
        var Orientation = null;
        //上传文件
        var file=this.files[0];
        if(file){
            //读取文件
            var reader=new FileReader();
            //将文件以Data URL形式读入页面
            reader.readAsDataURL(file);
            reader.onload=function(){
                // 通过 reader.result 来访问生成的 DataURL
                var url=reader.result;
                setImageURL(url);
            };
            var image=new Image();
            function setImageURL(url){
                image.src=url;
            }
            EXIF.getData(file, function() {
                //alert(EXIF.pretty(this));
                EXIF.getAllTags(this);
                //alert(EXIF.getTag(this, 'Orientation'));
                Orientation = EXIF.getTag(this, 'Orientation');
            });

            var canvas=document.getElementById("i-img1");
            var ctx=canvas.getContext('2d');
            image.onload = function(){
                var old_width;
                var old_height;
                var div_width=$("#i-img1").width();
                old_width=image.width;
                old_height=image.height;
                var scale_x=div_width*old_width/old_height;
                var scale_y=div_width*old_height/old_width;
                //清除
                ctx.clearRect(0,0,canvas.width,canvas.height);
                //苹果手机
                //alert(Orientation);
                if(isiOS){
                    if(Orientation == 6){
                                var degree =90*Math.PI/180;
                                ctx.rotate(degree);
                                ctx.drawImage(image,0,0,old_width,old_height,-(scale_x-div_width)/2,-div_width,scale_x,div_width);
                        ctx.rotate(-degree);
                    }else if(Orientation == undefined || Orientation == '' || Orientation == 1 ){
                        if(old_height>old_width){
                            ctx.drawImage(image,0,0,old_width,old_height,0,-(scale_y-div_width)/2,div_width,scale_y);
                        }else{
                            ctx.drawImage(image,0,0,old_width,old_height,-(scale_x-div_width)/2,0,scale_x,div_width);
                        }
                    }
                }else if(isAndroid){
                    if(old_height>old_width){
                        ctx.drawImage(image,0,0,old_width,old_height,0,-(scale_y-div_width)/2,div_width,scale_y);
                    }else{
                        ctx.drawImage(image,0,0,old_width,old_height,-(scale_x-div_width)/2,0,scale_x,div_width);
                    }
                }


//提交

注意：这一部分是获取到图片的64位 路径  picture_src直接当路径使用
                $('.obj').on(touchstart, function () {

                    var data=canvas.toDataURL();
                    data=data.split(',')[1];
                    data=window.atob(data);
                    var ia = new Uint8Array(data.length);
                    for (var i = 0; i < data.length; i++) {
                        ia[i] = data.charCodeAt(i);
                    };
                    var blob=new Blob([ia], {type:"image/png"});
                    picture_src=window.URL.createObjectURL(blob);

                })



            }
        }
    });
