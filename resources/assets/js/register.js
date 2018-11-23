var $$ = mdui.JQ;
$$(document).ready(function () {
    // 保存图形验证码是否正确状态
    var captchaStatus = false;
    var smsStatus = '';
    var ready = false;
    var captcha = $$('#captcha');
    var vercode = $$('#vercode');
    var phone = $$('#phone');
    var submit = $$('#submit');
   
    submit.on('click', function (event) {
        var e = event || window.event;
        if (!ready) {
            if (!phone.val() || !phone.val().match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|17[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$$/)) {
                phone.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
                e.preventDefault();
                return false;
            }
            if (!captchaStatus) {
                captcha.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
                e.preventDefault();
                return false;
            }
            $$('.form-group-phone').css('display', 'none');
            $$('.form-group-captcha').css('display', 'none');
            $$('.form-group-sms').css('display', 'block');
            if (!smsStatus) {
                sendsms(phone.val());
                return false;
            }
        }
    });
    // 校验图形验证码
    captcha.on('keyup', function () {
        var value = captcha.val();
        // 限定验证码长度为4位
        if (value.length === 4) {
            $$.ajax({
                method: 'POST',
                url: '/ajax/captcha',
                ContentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    captcha: value
                },
                success: function (data) {
                    if (JSON.parse(data).captcha) {
                        $$('#submit').text('下 一 步');
                        $$('.captcha-check-icon').css('display', 'inline');
                        captchaStatus = true;
                        // if (phone.val()) {
                        //     smstips();
                        //     sendsms(phone.val());
                        // }
                    } else {
                        captchaStatus = false;
                        $$('.captcha-check-icon').css('display', 'none');
                        captcha.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
                    }
                }
            })
        } else {
            captchaStatus = false;
            $$('.captcha-check-icon').css('display', 'none');
            captcha.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
        }
    });
    // 校验短信验证码
    vercode.on('keyup', function () {
        // 限定验证码长度为5位
        if (vercode.val().length === 5) {
            $$.ajax({
                method: 'POST',
                url: '/ajax/smscode',
                ContentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    smscode: vercode.val(),
                    captcha: captcha.val()
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.smscode) {
                        vercode.parent('.mdui-textfield').removeClass('mdui-textfield-invalid-html5');
                        $$('.smscode-check-icon').css('display', 'inline');
                        ready = true;
                    } else {
                        $$('.smscode-check-icon').css('display', 'none');
                        vercode.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
                        ready = false;
                    }
                    smsStatus = data.value;
                }
            })
        } else {
            smsStatus = '';
            ready = false;
            $$('.smscode-check-icon').css('display', 'none');
            vercode.parent('.mdui-textfield').addClass('mdui-textfield-invalid-html5');
        }
    });

    function smstips() {
        var num = 60;
        $$('.sendsms-title').empty().append("我们已经向您的手机<span>" + phone.val() + "</span>发送了一条验证码")
        var interval = setInterval(function(){ 
            $$('.sendsmstips').empty();
            if (num < 0) {
                $$('.sendsmstips').append("<a id='btnsendsms' href='javascript:;'>重新发送验证码?</a>")
                clearInterval(interval);
                $$('#btnsendsms').on('click', function () {
                    sendsms(phone.val());
                })
                return;
            }
            $$('.sendsmstips').append("没收到?<span>" + num + "秒</span>后重新获取。");
            num--;
        },1000);
    };
    
    // 发送验证码
    function sendsms(phoneNumber) {
        $$.ajax({
            method: 'POST',
            url: '/ajax/sendsms',
            ContentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $$('meta[name="csrf-token"]').attr('content')
            },
            data: {
                phone: phoneNumber,
                captcha: captcha.val()
            },
            success: function (data) {
                smstips();
            }
        })
    }
});


// 滑块验证码
// var $$ = mdui.JQ;
// var success = false; //是否通过验证的标志
// $$(document).ready(function () {
//     //一、定义一个获取DOM元素的方法
//     var $$ = function (selector) {
//             return document.querySelector(selector);
//         },
//         box = $$(".lock-drag"), //容器
//         bg = $$(".bg"), //背景
//         text = $$(".text"), //文字
//         btn = $$(".btn"), //滑块

//         distance = box.offsetWidth - btn.offsetWidth; //滑动成功的宽度（距离）
//     //二、给滑块注册鼠标按下事件
//     btn.onmousedown = function (e) {
//         if(success) return;
//         //1.鼠标按下之前必须清除掉后面设置的过渡属性
//         btn.style.transition = "";
//         bg.style.transition = "";
//         //说明：clientX 事件属性会返回当事件被触发时，鼠标指针向对于浏览器页面(或客户区)的水平坐标。
//         //2.当滑块位于初始位置时，得到鼠标按下时的水平位置
//         var e = e || window.event;
//         var downX = e.clientX;
//         //三、给文档注册鼠标移动事件
//         document.onmousemove = function (e) {
//             if(success) return;
//             var e = e || window.event;
//             //1.获取鼠标移动后的水平位置
//             var moveX = e.clientX;
//             //2.得到鼠标水平位置的偏移量（鼠标移动时的位置 - 鼠标按下时的位置）
//             var offsetX = moveX - downX;

//             //3.在这里判断一下：鼠标水平移动的距离 与 滑动成功的距离 之间的关系
//             if (offsetX > distance) {
//                 offsetX = distance; //如果滑过了终点，就将它停留在终点位置
//             } else if (offsetX < 0) {
//                 offsetX = 0; //如果滑到了起点的左侧，就将它重置为起点位置
//             }
//             //4.根据鼠标移动的距离来动态设置滑块的偏移量和背景颜色的宽度
//             btn.style.left = offsetX + "px";
//             bg.style.width = offsetX + "px";
//             //如果鼠标的水平移动距离 = 滑动成功的宽度
//             if (offsetX == distance) {
//                 //1.设置滑动成功后的样式
//                 text.innerHTML = "验证通过";
//                 text.style.color = "#fff";
//                 btn.innerHTML = "&radic;";
//                 btn.style.color = "green";
//                 bg.style.backgroundColor = "lightgreen";
//                 //2.设置滑动成功后的状态
//                 success = true;
//                 //成功后，清除掉鼠标按下事件和移动事件（因为移动时并不会涉及到鼠标松开事件）
//                 btn.onmousedown = null;
//                 document.onmousemove = null;
//             }
//         }

//         //四、给文档注册鼠标松开事件
//         document.onmouseup = function (e) {
//             //如果鼠标松开时，滑到了终点，则验证通过
//             if (success) {
//                 return;
//             } else {
//                 //反之，则将滑块复位（设置了1s的属性过渡效果）
//                 btn.style.left = 0;
//                 bg.style.width = 0;
//                 btn.style.transition = "left 1s ease";
//                 bg.style.transition = "width 1s ease";
//             }
//             //只要鼠标松开了，说明此时不需要拖动滑块了，那么就清除鼠标移动和松开事件。
//             document.onmousemove = null;
//             document.onmouseup = null;
//         }

//     }
//     var clientX = 0;
//     $$('.btn').on('touchstart', function () {
//         btn.style.transition = "";
//         bg.style.transition = "";
//         var touch;
//         if (event.touches) {
//             touch = event.touches[0];
//         } else {
//             touch = event;
//         }
//         clientX = touch.clientX;
//     });

//     $$('.btn').on('touchmove', function () {
//         var touch;
//         var btnLeft = btn.offsetLeft;
//         if (event.touches) {
//             touch = event.touches[0];
//         } else {
//             touch = event;
//         }
//         var offsetX = touch.clientX - clientX;
//         //3.在这里判断一下：鼠标水平移动的距离 与 滑动成功的距离 之间的关系
//         if (offsetX > distance) {
//             offsetX = distance; //如果滑过了终点，就将它停留在终点位置
//         } else if (offsetX < 0) {
//             offsetX = 0; //如果滑到了起点的左侧，就将它重置为起点位置
//         }
//         btn.style.left = offsetX + "px";
//         bg.style.width = offsetX + "px";

//         //如果鼠标的水平移动距离 = 滑动成功的宽度
//         if (offsetX == distance) {
//             //1.设置滑动成功后的样式
//             text.innerHTML = "验证通过";
//             text.style.color = "#fff";
//             btn.innerHTML = "&radic;";
//             btn.style.color = "green";
//             bg.style.backgroundColor = "lightgreen";

//             //2.设置滑动成功后的状态
//             success = true;
//             //成功后，清除掉鼠标按下事件和移动事件（因为移动时并不会涉及到鼠标松开事件）
//             $$('.btn').off('touchmove');
//             $$('.btn').off('touchstart');
//         }
//         //阻止页面的滑动默认事件
//         event.preventDefault();
//     });

//     $$('.btn').on('touchend', function () {
//         //如果鼠标松开时，滑到了终点，则验证通过
//         if (success) {
//             //只要鼠标松开了，说明此时不需要拖动滑块了，那么就清除鼠标移动和松开事件。
//             $$('.btn').off('touchmove');
//             $$('.btn').off('touchend');
//             $$('.btn').off('touchstart');
//             return;
//         } else {
//             //反之，则将滑块复位（设置了1s的属性过渡效果）
//             btn.style.left = 0;
//             bg.style.width = 0;
//             btn.style.transition = "left 1s ease";
//             bg.style.transition = "width 1s ease";
//         }
//     });


// });