<!DOCTYPE html>
<html lang="ko">
<head>
   <meta charset="UTF-8">
   <title>Document</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div id="wrap">
		<div class="gameover"></div>
		<div class="checkmate">Checkmate</div>
	<div class="text_box"><h1>turn : black</h1></div>
	<ul id="chesswrap">
		<li><img src="images/whiterook.png" alt="whiteRook" class="whiterook"></li>
		<li><img src="images/whiteknight.png" alt="whiteKnight" class="whiteknight"></li>
		<li><img src="images/whitebishop.png" alt="whiteBishop" class="whitebishop"></li>
		<li><img src="images/whitequeen.png" alt="whiteQueen" class="whitequeen"></li>
		<li><img src="images/whiteking.png" alt="whiteKing" class="whiteking"></li>
		<li><img src="images/whitebishop.png" alt="whiteBishop" class="whitebishop"></li>
		<li><img src="images/whiteknight.png" alt="whiteKnight" class="whiteknight"></li>
		<li><img src="images/whiterook.png" alt="whiteRook" class="whiterook"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li><img src="images/whitepawn.png" alt="whitePawn" class="whitepawn"></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackpawn.png" alt="blackPawn" class="blackpawn"></li>
		<li><img src="images/blackrook.png" alt="blackRook" class="blackrook"></li>
		<li><img src="images/blackknight.png" alt="blackKnight" class="blackknight"></li>
		<li><img src="images/blackbishop.png" alt="blackBishop" class="blackbishop"></li>
		<li><img src="images/blackqueen.png" alt="blackQueen" class="blackqueen"></li>
		<li><img src="images/blackking.png" alt="blackKing" class="blackking"></li>
		<li><img src="images/blackbishop.png" alt="blackBishop" class="blackbishop"></li>
		<li><img src="images/blackknight.png" alt="blackKnight" class="blackknight"></li>
		<li><img src="images/blackrook.png" alt="blackRook" class="blackrook"></li>
	</ul>
	<div class="death_result">
		<div class="w_death"><h3>death_result</h3></div>
		<div class="b_death"></div>
	</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	let 
	black=1, 
	count=0, 
	thisidx,
	turn=0,
	arr = {},
	before;
	
	window.onload = _ => {
		locationInsert("insert"); // 현재 위치를 데이터베이스에 저장함
	}

	for(let i=0; i<32; i++){ // 체스판 생성
		$("#chesswrap li:nth-child("+black+")").css({"background" : "black"});
		black+=2;
		count++;
		if( count%4 == 0 ) black++;
		if( count%8 == 0 ) black=black-2;
	}
	
	$("#chesswrap li").click(function(){ // 체스칸 클릭
		let clickthis = $(this);
		let before= turn;
		let m= turn == 0? "black": "white";
		let e= turn != 0? "black": "white";

		if(clickthis.children("div").hasClass("move")){
			var className = $("#chesswrap li").eq(thisidx).find('img').attr('class');
			var firstCheck = ['pawn','king','rook'];
			firstCheck= firstCheck.map(v => m+v);

			if(firstCheck.indexOf(className)>=0){
				$("#chesswrap li").eq(thisidx).find('img').attr('data-first',1);
			}

			if(clickthis.find("img").attr('src') != undefined){
				$(`.${e[0]}_death`).append(`<img src='${clickthis.find("img").attr('src')}'>`);

				if(clickthis.find('img').attr('class') == `${e}king`){
					$(".gameover").css({"display" : "block"}).text(`${m} Win!`);
				}
			}

			var clone = $("#chesswrap>li").eq(thisidx).find("img").clone();

			clickthis.find("img").remove();

			if(clone.attr('class') == `${m}pawn` && !~~(clickthis.index()/8)){// 끝까지 가면 퀸으로 됨
				clone =	$(".blackqueen").clone();
			}

			clickthis.append(clone);
			$("#chesswrap li").eq(thisidx).find("img").remove();

			turn= (turn+1)%2;
			locationInsert('update',className);
		}else if(clickthis.find('div').hasClass('castling')){ //캐슬링
			clickthis.append($("#chesswrap li").eq(thisidx).find('img').attr('data-first',1));
			$("#chesswrap li").eq(thisidx).find("img").remove();

			if(clickthis.index()== (turn == 0? 58: 2)){
				$("#chesswrap li").eq(clickthis.index()+1).append($("#chesswrap li").eq(turn == 0? 56: 0).find('img'));
				$("#chesswrap li").eq(turn == 0? 56: 0).find('img').remove();
			}else{
				$("#chesswrap li").eq(clickthis.index()-1).append($("#chesswrap li").eq(turn == 0? 63: 7).find('img'));
				$("#chesswrap li").eq(turn == 0? 63: 7).find('img').remove();
			}

			$(".castling").remove();
			turn= (turn+1)%2;
			locationInsert('update',className);
		}
		$('.move').remove();
		$('.castling').remove();
		$(".focus").removeClass();
		if(clickthis.find('img')[0])
			thisidx=clickthis.index();
		if(clickthis.find("img")[0] && clickthis.find("img").attr('class').indexOf(m) == 0){
			clickthis.addClass('focus');
			move[clickthis.find("img").attr('class').replace(m, "")]({
				enemy: e,
				calc: (16*turn)-8,
				my: m,
				name: clickthis.find("img").attr('class').replace(m, "")
			});
		}
		
		$(".move").each(function (){
			if($(this).prev().attr('class') == (turn == 1? 'whiteking': 'blackking')){
				$(".checkmate").css({"display" : "block"});
				setTimeout(function(){
					$(".checkmate").css({"display" : "none"});
				},700);
			}
		});
		if(before != turn){	//턴이 바뀌었으면
			$(".text_box")
				.css({"background" : turn == 1? "black": "white"})
				.html(`<h1 style="color:${turn != 1? "black": "white"}">turn : ${turn != 1? "black": "white"}</h1>`);
			$(".move").remove();
			$(".castling").remove();
			$(".focus").removeClass();
		}
	})
	// let enemy, calc, my, name;
	const move= {
		pawn: ({enemy, calc}) =>{
			/*enemy= d.enemy;
			calc= d.calc;*/
			if(!$("#chesswrap li").eq(thisidx + calc).find("img")[0]){ //앞에 말이 없다면
				$("#chesswrap li").eq(thisidx + calc).append('<div class="move"></div>');
			}
			if($("#chesswrap li").eq(thisidx).find("img").attr('data-first') == undefined && !$("#chesswrap li").eq(calc * 2 + thisidx).find("img")[0]){
				$("#chesswrap li").eq(calc * 2 + thisidx).append('<div class="move"></div>');
			}
			let right = String($("#chesswrap li").eq(thisidx+calc+1).find("img").attr('src')); //대각선
			let left = String($("#chesswrap li").eq(thisidx+calc-1).find("img").attr('src'));
			if(right.indexOf(enemy) >= 0 && parseInt((thisidx+calc) / 8) == parseInt((thisidx+calc+1) / 8)){
				$("#chesswrap li").eq(thisidx+calc+1).append('<div class="move"></div>');
			}
			if(left.indexOf(enemy) >= 0 && parseInt((thisidx+calc) / 8) == parseInt((thisidx+calc-1) / 8)){
				$("#chesswrap li").eq(thisidx+calc-1).append('<div class="move"></div>');
			}
		},
		rook: function ({my, enemy}){
			/*my= d.my;
			enemy= d.enemy;*/
			for(var i=thisidx-1; i>=parseInt(thisidx/8)*8; i--){ //왼쪽
				if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
			}
			for(var i=thisidx+1; i<parseInt(thisidx/8)*8+8; i++){ //오른쪽
				if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
			}
			for(var i=thisidx-8; i>=parseInt(thisidx%8); i-=8){ //위쪽
				if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
			}
			for(var i=thisidx+8; i<64; i+=8){//아래쪽
				if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
			}
		},
		knight: ({my}) =>{
			// my= d.my;
			if(thisidx%8!=0 && thisidx-1-16 >= 0&&($("#chesswrap li").eq(thisidx-1-16).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx-1-16).find('img').attr('class').indexOf(my) ==-1))
				$("#chesswrap li").eq(thisidx-1-16).append('<div class="move"></div>');
			if(thisidx+1 < parseInt(thisidx/8+1)*8 && thisidx+1-16 >= 0 && ($("#chesswrap li").eq(thisidx+1-16).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx+1-16).find('img').attr('class').indexOf(my) ==-1))
				$("#chesswrap li").eq(thisidx+1-16).append('<div class="move"></div>');
			// 위쪽 좌우
			if(thisidx%8!=0 &&thisidx-1+16 < 64 &&($("#chesswrap li").eq(thisidx-1+16).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx-1+16).find('img').attr('class').indexOf(my) ==-1))
				$("#chesswrap li").eq(thisidx-1+16).append('<div class="move"></div>');
			if(thisidx+1 < parseInt(thisidx/8+1)*8 && thisidx+1+16 < 64 && ($("#chesswrap li").eq(thisidx+1+16).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx+1+16).find('img').attr('class').indexOf(my) ==-1))	
				$("#chesswrap li").eq(thisidx+1+16).append('<div class="move"></div>');
			//아래쪽 좌우
			if(thisidx%8!=1&&thisidx%8!=0&& thisidx-2-8 >= 0&& ($("#chesswrap li").eq(thisidx-2-8).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx-2-8).find('img').attr('class').indexOf(my) ==-1))
				$("#chesswrap li").eq(thisidx-2-8).append('<div class="move"></div>');	
			if(thisidx%8!=1&&thisidx%8!=0 && thisidx-2+8 < 64&&($("#chesswrap li").eq(thisidx-2+8).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx-2+8).find('img').attr('class').indexOf(my) ==-1))
				$("#chesswrap li").eq(thisidx-2+8).append('<div class="move"></div>');
			// 왼쪽 상하
			if(thisidx+2<parseInt(thisidx/8+1)*8&& thisidx+2-8 >= 0&&($("#chesswrap li").eq(thisidx+2-8).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx+2-8).find('img').attr('class').indexOf(my) ==-1))
				$("#chesswrap li").eq(thisidx+2-8).append('<div class="move"></div>');
			if(thisidx+2<parseInt(thisidx/8+1)*8 && thisidx+2+8 < 64 &&($("#chesswrap li").eq(thisidx+2+8).find('img').attr('class')==undefined || $("#chesswrap li").eq(thisidx+2+8).find('img').attr('class').indexOf(my) ==-1))
				$("#chesswrap li").eq(thisidx+2+8).append('<div class="move"></div>');
			// 오른쪽 상하
		},
		bishop: ({my,enemy,name}) =>{
			/*my= d.my;
			enemy= d.enemy;
			name= d.name;*/
			for(var i=thisidx; i>=0; i-=9){	//왼쪽 위
				var c = $("#chesswrap li").eq(i).find("img").attr('class');
				if(c!=undefined&&c.indexOf(name) >= 0&&i%8==0)
					break;
				else if(c!=undefined&&c.indexOf(name) >= 0)
					continue;
				if(c!=undefined&&c.indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
				if(i%8 == 0)
					break;
			}
			for(var i=thisidx; i>=0; i-=7){ // 오른쪽 위
				var c = $("#chesswrap li").eq(i).find("img").attr('class');
				if(c!=undefined&&c.indexOf(name) >= 0&&(i+1)%8==0)
					break;
				else if(c!=undefined&&c.indexOf(name) >= 0)
					continue;
				if(c!=undefined&&c.indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
				if((i+1)%8==0)
					break;
			}
			for(var i=thisidx; i<64; i+=7){ // 왼쪽 아래
				var c = $("#chesswrap li").eq(i).find("img").attr('class');
				if(c!=undefined&&c.indexOf(name) >= 0&&i%8==0)
					break;
				else if(c!=undefined&&c.indexOf(name) >= 0)
					continue;
				if(c!=undefined&&c.indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
				if(i%8==0)
					break;
			}
			for(var i=thisidx; i<64; i+=9){ // 오른쪽 아래
				var c = $("#chesswrap li").eq(i).find("img").attr('class');
				if(c!=undefined&&c.indexOf(name) >= 0&&(i+1)%8==0)
					break;
				else if(c!=undefined&&c.indexOf(name) >= 0)
					continue;
				if(c!=undefined&&c.indexOf(my)>=0)
					break;
				else if($("#chesswrap li").eq(i).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(i).find("img").attr('class').indexOf(enemy)>=0){
					$("#chesswrap li").eq(i).append('<div class="move"></div>');
					break;
				}
				$("#chesswrap li").eq(i).append('<div class="move"></div>');
				if((i+1)%8==0)
					break;
			}
		},
		king: ({my}) =>{
			// my= d.my;
			if(thisidx+1 < 64&&($("#chesswrap li").eq(thisidx+1).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx+1).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx+1).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx+1).append('<div class="move"></div>');
			if(thisidx-1 >= 0&&($("#chesswrap li").eq(thisidx-1).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx-1).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx-1).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx-1).append('<div class="move"></div>');
			//좌우
			if(thisidx+7 < 64&&($("#chesswrap li").eq(thisidx+7).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx+7).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx+7).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx+7).append('<div class="move"></div>');
			if(thisidx+9 < 64&&($("#chesswrap li").eq(thisidx+9).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx+9).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx+9).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx+9).append('<div class="move"></div>');
			//아래 좌우
			if(thisidx+8 < 64&&($("#chesswrap li").eq(thisidx+8).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx+8).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx+8).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx+8).append('<div class="move"></div>');
			if(thisidx-8 >= 0&&($("#chesswrap li").eq(thisidx-8).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx-8).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx-8).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx-8).append('<div class="move"></div>');
			//직선 위아래
			if(thisidx-7 >= 0&&($("#chesswrap li").eq(thisidx-7).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx-7).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx-7).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx-7).append('<div class="move"></div>');
			if(thisidx-9 >= 0&&($("#chesswrap li").eq(thisidx-9).find("img").attr('class')==undefined||($("#chesswrap li").eq(thisidx-9).find("img").attr('class')!=undefined&&$("#chesswrap li").eq(thisidx-9).find("img").attr('class').indexOf(my)==-1)))
				$("#chesswrap li").eq(thisidx-9).append('<div class="move"></div>');
			//위 좌우
			move.castling({my});
		},
		castling: ({my}) =>{
			if($("#chesswrap li").eq(thisidx).find("img").attr('data-first')==undefined){
				for(var i= thisidx-1; i>= ~~(thisidx/8)*8; i--){
					if(!$("#chesswrap li").eq(i).find("img").hasClass(my+'rook') && $("#chesswrap li").eq(i).find('img').attr('class') != undefined){
						break;
					// }else if($("#chesswrap li").eq(i).find("img").hasClass(my+'rook')){
					}else if($("#chesswrap li").eq(i).find("img").hasClass(my+'rook')){
						if($("#chesswrap li").eq(i).find("img").attr('data-first') == undefined){
							console.log("aa");
							$("#chesswrap li").eq(thisidx-2).append('<div class="castling"></div>');
						}
					}
				}
				for(var i= thisidx+1; i< ~~(thisidx/8)*8+8; i++){
					if(!$("#chesswrap li").eq(i).find("img").hasClass(my+'rook')&&$("#chesswrap li").eq(i).find('img').attr('class') != undefined){
						break;
					}else if($("#chesswrap li").eq(i).find("img").hasClass(my+'rook')){
						console.log("right castling");
						if($("#chesswrap li").eq(i).find("img").attr('data-first') == undefined){
							$("#chesswrap li").eq(thisidx+2).append('<div class="castling"></div>');
						}
					}
				}
			}
		},
		queen: ({my,enemy,name}) =>{
			move.rook({my,enemy});
			move.bishop({my,enemy,name});
		}
	};

	function locationInsert(DML,thispiece){
		arr = {};

		$("li > img").each(function(){
			let className = $(this).attr('class');
			let value = $(this).parent().index();
			arr[`${className}`] == undefined? arr[`${className}`] = value+"" : arr[`${className}`] += ","+value;
		});

		$.ajax({
			url: '/action/insert',
            type: 'POST',
            datatype : 'json',
            data: {arr : arr, DML : DML, thispiece : thispiece},
            success : function(data){
            	console.log(data);
            }
		});
	}

	function update(){
		console.log("a");
		$.ajax({
			url: '/action/update',
            type: 'GET',
            success : function(data){
            	data = JSON.parse(data);
            	data = Object.entries(data[0]);
				data = data.filter((v,idx)=> idx > 11);

				let bool = false;
				for(let i=0; i<data.length; i++){
					if(before != undefined&&data[i][1] != before[i][1]) // 데이터가 바뀌었는지 확인
						bool = true;
				}
            	if(before != undefined && bool){
            		console.log("data change");
            		data.map( (v,idx) => {
						let location = v[1].split(","); // 위치
            			let belocat = before[idx][1].split(","); // 전에 있던 위치
            			
            			location.map( (val,i) =>{
            				let clone = $("li").eq(belocat[i]).find('img').clone(); // 아직 이동 전이므로 예전 위치에서 정보를 가져옴
            				$("li").eq(~~val).append(clone);
            			})
            			$("li").each(function(){
            				if($(this).children('img').length > 1)
            					$(this).children('img').eq(0).remove();
            			})
            		});
            	}
            	before = data;
            }
		});
	}

	setInterval(function(){
		update();
	},100);
// })();
</script>
</html>