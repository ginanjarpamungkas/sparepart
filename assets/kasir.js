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
      if (document.getElementById('c'+$f).checked) {
        $z=$z+"|±"+document.getElementById('c'+$f).value+"±"+document.getElementById('a'+$f).value+"±"+document.getElementById('b'+$f).value+"±"+document.getElementById('total'+$f).value;
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
