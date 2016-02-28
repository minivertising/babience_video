<?

$output	= "ffmpeg \\";
$output	.= "-loop 1 -t 1 -i ../files/4C12029A69/medium/final_4C12029A69_1.jpg \\";
$output	.= "-loop 1 -t 1 -i ../files/4C12029A69/medium/final_4C12029A69_2.jpg \\";
$output	.= "-loop 1 -t 1 -i ../files/4C12029A69/medium/final_4C12029A69_3.jpg \\";
$output	.= "-loop 1 -t 1 -i ../files/4C12029A69/medium/final_4C12029A69_4.jpg \\";
$output	.= "-loop 1 -t 1 -i ../files/4C12029A69/medium/final_4C12029A69_4.jpg \\";
$output	.= "-filter_complex \\";
$output	.= '"[1:v][0:v]blend=all_expr=';
$output	.= "'A*(if(gte(T,0.5),1,T/0.5))+B*(1-(if(gte(T,0.5),1,T/0.5)))'[b1v]; \\";
$output	.= " [2:v][1:v]blend=all_expr='A*(if(gte(T,0.5),1,T/0.5))+B*(1-(if(gte(T,0.5),1,T/0.5)))'[b2v]; \\";
$output	.= " [3:v][2:v]blend=all_expr='A*(if(gte(T,0.5),1,T/0.5))+B*(1-(if(gte(T,0.5),1,T/0.5)))'[b3v]; \\";
$output	.= " [4:v][3:v]blend=all_expr='A*(if(gte(T,0.5),1,T/0.5))+B*(1-(if(gte(T,0.5),1,T/0.5)))'[b4v]; \\";
$output	.= ' [0:v][b1v][1:v][b2v][2:v][b3v][3:v][b4v][4:v]concat=n=9:v=1:a=0,format=yuv420p[v]" -pix_fmt yuv420p -map "[v]"  ./4C12029A69/out5.mp4';

	
	system(stripslashes($output));
	//print_r($output); 
	print_r(stripslashes($output));
?>