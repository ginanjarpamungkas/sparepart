function kali() { 
    $n=0;
    for ($i =1; $i < (document.getElementById('max').value); $i++) {
    a=document.getElementById('a'+$i).value;
    b=document.getElementById('b'+$i).value;
    $c=a*b;
    document.getElementById('total'+$i).value=$c;
   $n=$n+$c;
    document.getElementById('jumlah').value=$n;
   };
};

function klik(){
      $z="";
    for ($f = 1 ; $f < (document.getElementById('max').value); $f++) {
      if (document.getElementById('total'+$f) != null) {
        $z=$z+"|±"+document.getElementById('c'+$f).value+"±"+document.getElementById('a'+$f).value+"±"+document.getElementById('b'+$f).value+"±"+document.getElementById('total'+$f).value+"±"+document.getElementById('stok'+$f).value;
      };

    };
    document.getElementById('w').value=$z;
};

function kembali(){
       $t=document.getElementById('tunai').value;
       $j=document.getElementById('jumlah').value;
       $i= $t-$j;
       document.getElementById('kembalian').value=$i;
};

function haha(){
  if (document.getElementById('kembalian').value >= 0) {
        document.getElementById('button').disabled = false ;
       }else{
        document.getElementById('button').disabled = true ;
       };
};

function f_validchar($validcharacter,$event){
  $event=($event)?$event:window.event;
  if(("|8|13|37|38|39|40|46|").indexOf($event.which)>0)return true; //|backspace|enter|left|down|up|right|delete|
  return($validcharacter.indexOf(String.fromCharCode($event.which))<0?false:true)
};

function total(){
  $total=0;
  for (var i = 1 ; i < 12; i++) {
    if (document.getElementById('total'+i)!= null){
      $j=parseInt(document.getElementById('total'+i).value)
      $total = $total+$j;
    }
  }

  document.getElementById('jumlah').value=$total;

}

function f_currency($this){
  $value=($this.value+"").split("").reverse().join("");
  $temp="";for($i=0;$i<$value.length;$i++)$temp=$temp+$value.substr($i,1)+($i%3==2?".":"");
  $temp=($temp+"").split("").reverse().join("")+",-";
  $temp=($temp.indexOf(".")==0?$temp.substr(1):$temp);
  $temp=($temp.indexOf("-.")==0?"-"+$temp.substr(2):$temp);
  return $temp;
}