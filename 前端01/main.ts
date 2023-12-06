var zc = (x: number) => Math.floor(x); 
function zeller(y:number, m:number, d:number): number{
    var w:number = 0;
    var c:number = 0;
    if (m == 1 || m == 2){
		m += 12;
		y--;
	}
    c = zc(y / 100);
	y = y % 100;
	w = y + zc(y / 4) + zc(c / 4) - 2 * c + zc(26 * (m + 1) / 10) + d - 1;
    while (w < 0){
        w += 7;
    }
	w = w % 7;
	return w;
}

var res:string = ''

// var st:string | null = prompt("请输入一个数字：");
var n:number = 2000;

// if (st != null) {
//     n = parseFloat(st);

//     if (isNaN(n)) {
//         console.log("输入非法数字");
//     }
// } else {
//     console.log("用户取消了输入.")
// }

res += `年份${n}的日历:\n`
var prime:boolean = false;
if (n % 4 == 0) {
    if (n % 100 == 0 && n % 400 != 0)
        prime = false;
    else if (n % 400 == 0)
        prime = true;
    else
        prime = true;
}

var yue:number[] = [ 31,28 + (prime ? 1 : 0),31,30,31,30,31,31,30,31,30,31 ];
var yuef:number[] = [0,0,0,0,0,0,0,0,0,0,0,0];
var fd:number[] = [zeller(n,1,1),zeller(n,2,1),zeller(n,3,1),zeller(n,4,1),zeller(n,5,1),zeller(n,6,1),zeller(n,7,1),zeller(n,8,1),zeller(n,9,1),zeller(n,10,1),zeller(n,11,1),zeller(n,12,1)]

var fd: number[] = fd.map(Number);

var i:number, j:number, k:number;
j = 0;
for (i = 0; i < 4; i++) {

    for (k = 0; k < 3; k++) {
        j++;
        if (k != 2) {
            if (j > 9)
            res += "           " + j + "月                 "
            else if (j < 10)
                res += "            " + j + "月                 "
        }
        else {
            if (j > 9)
            res += "           " + j + "月";
            else if (j < 10)
                res += "            " + j + "月";
        }
    }
    res += "\n";
    for (k = 0; k < 3; k++) {
        if (k != 2)
            res += "Sun Mon Tue Wed Thu Fri Sat     ";
        else
            res += "Sun Mon Tue Wed Thu Fri Sat";
    }
    res += "\n";
    var k1:boolean = false, k2:boolean = false, k3:boolean = false;
    while (1) {
        var y:number = j - 3;
        if (!k1) {
            switch (fd[y]) {
                case 0:
                    break;
                case 1:
                    res += "    ";
                    break;
                case 2:
                    res += "        ";
                    break;
                case 3:
                    res += "            ";
                    break;
                case 4:
                    res += "                ";
                    break;
                case 5:
                    res += "                    ";
                    break;
                case 6:
                    res += "                        ";
                    break;
            }
            k1 = true;
        }
        while(1) {
            if (yuef[y] < yue[y]) {
                yuef[y]++;

                res += (`${yuef[y]}` as any).padEnd(4);
                
            }
            else
                res += "    ";
            fd[y]++;
            if (fd[y] % 7 == 0)
                break;
        }
        y++;
        res += "    ";
        if (!k2) {
            switch (fd[y]) {
                case 0:
                    break;
                case 1:
                    res += "    ";
                    break;
                case 2:
                    res += "        ";
                    break;
                case 3:
                    res += "            ";
                    break;
                case 4:
                    res += "                ";
                    break;
                case 5:
                    res += "                    ";
                    break;
                case 6:
                    res += "                        ";
                    break;
            }
            k2 = true;
        }
        while (1) {
            if (yuef[y] < yue[y]) {
                yuef[y]++;
                res += (`${yuef[y]}` as any).padEnd(4);
                
            }
            else
                res += "    ";
            fd[y]++;
            if (fd[y] % 7 == 0)
                break;
        }
        y++;
        res += "    ";
        if (!k3) {
            switch (fd[y]) {
                case 0:
                    break;
                case 1:
                    res += "    ";
                    break;
                case 2:
                    res += "        ";
                    break;
                case 3:
                    res += "            ";
                    break;
                case 4:
                    res += "                ";
                    break;
                case 5:
                    res += "                    ";
                    break;
                case 6:
                    res += "                        ";
                    break;
            }
            k3 = true;
        }
        while (1) {
            if (yuef[y] < yue[y]) {
                yuef[y]++;
                res += (`${yuef[y]}` as any).padEnd(4);
                
            }
            else
                res += "    ";
            fd[y]++;
            if (fd[y] % 7 == 0)
                break;
        }
        res += "\n";
        y = j - 3;
        if (yuef[y] == yue[y] && yuef[y + 1] == yue[y + 1] && yuef[y + 2] == yue[y + 2])
            break;
    }
    
}

console.log(res);