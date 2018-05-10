<!doctype html>
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>css 阴影效果</title>
    <!-- Styles -->
    <style>
       body {
           font-family: Arial;
           font-size: 20px;
       }
        body,ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .wrap {
            width: 70%;
            height: 200px;
            margin: 50px auto;
            background: #f0f0f0;
        }
        .wrap h1 {
            font-size: 20px;
            text-align: center;
            line-height: 200px;

        }
        .effect {
            position: relative;
            box-shadow: 0 1px 4px rgba(0,0,0,0.3),
                        0 0 40px  rgba(0,0,0,0.1)
                        inset ;
            -webkit-box-shadow: 0 1px 4px rgba(0,0,0,0.3),
            0 0 40px rgba(0,0,0,0.1) inset ;
            /*css box shadow 实现
              一个或多个参数*/
            /*-webkit-box-shadow: ;*/
            /*-moz-box-shadow: ;*/
            /*-o-box-shadow: ;*/
        }
        .effect:after, .effect:before{
            content: '';
            z-index: -1;
            position: absolute;
            background: #f00;
            top: 50%;
            bottom: -1px;
            left: 10px;
            right: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.8);
            border-radius: 100px/10px;
        }

        .box {
            width: 980px;
            height:auto;
            clear: both;
            overflow:  hidden;
            margin:  20px auto;
        }
        .box li {
            position: relative;
            width: 300px;
            height: 210px;
            float: left;
            margin: 20px 10px;
            border: 4px solid #efefef;
            background: white;

            box-shadow: 0 1px 4px rgba(0,0,0,0.3),0 0px 60px rgba(0,0,0,0.1) inset ;
        }
       .box li :before{
           content: '';
           z-index: -2;
           position: absolute;
           width: 90%;
           height: 80%;
           left: 20px;
           bottom: 8px;
           background: red;
           box-shadow: 0 8px 20px  rgba(0,0,0,0.6);
           transform: skew(-12deg) rotate(-4deg);
       }
       .box li :after{
           content: '';
           z-index: -2;
           position: absolute;
           width: 90%;
           height: 80%;
           left: 10px;
           bottom: 8px;
           background: red;
           box-shadow: 0 8px 20px  rgba(0,0,0,0.6);
           transform: skew(12deg) rotate(4deg);
       }


       .box li img{
           display: block;
           background: #f0f0f0;
           margin: 10px;
           width: 280px;
           height: 190px;
       }

    </style>
</head>
<body>

<div class="wrap effect">
    <h1> shadow effect </h1>
</div>

<ul class="box">
    <li> <img alt="" src=""/>  </li>
</ul>

</body>
</html>
