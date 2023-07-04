<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>secret bottle</title>
     <!-- CSS only -->
     @vite('resources/css/app.css')
     <style>
        body {
            background-image: url('assets/img/sky.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .introduction_text {
            margin: 64px 36px 64px 36px;
        }

        p {
            font-size: 1rem;
            line-height: 160%;
            color: white;
        }

     </style>
</head>
<body class="flex justify-center">
    <main class="introduction_back">
        {{-- <div>
            <img src="assets/img/basic.png" alt="ひみつ表紙">
        </div> --}}
        <div class="introduction_text" >
            <p>
                誰しも人には話せない秘密や心に秘めた思いがあると思う。<br>
                大切な思い出なら、こころの奥底に保管しておくのも良いのだが、
                実は吐き出してしまいたい秘密もあるに違いない。<br>
                <br>
                さあ、心の澱になっているダークな秘密は街の雑踏に投げ捨ててしまおう。
                秘密は、地図に瓶に保存され 
                誰かが取り出すまでこの世の波に漂っている。
                秘密を投げ出した人は、他人のボトルを拾い、
                読むことで、誰か知らない人の秘密を共有することになる。<br>
                <br>
                秘密の暴露で少しは気持ちが晴れるだろうか。
                少しでも心が軽くなることを祈っている。
                それより、他人の秘密を覗く好奇心の方が膨らみ
                クセにならないといいのだが笑<br>
                <br>
                秘密の取扱には、くれぐれも注意しながら
                この世界を漕ぎ続けて欲しい。
                <br>
                <br>
                開発チーム：YABA-Pin
            </p>
        </div>
    </main>
    {{-- <style>
        .introduction_back {
            position: relative;
        }    
        .introduction_text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: left;
            font-size: 12.5px;
            line-height: 2; 
        }
    </style> --}}
</body>
</html>