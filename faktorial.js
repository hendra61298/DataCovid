function pemfaktoran(number) {
  let hasil = 1;
  if (number < 0) {
    return "Tidak terdefinisi";
  } else {
    if (number == 0 || number == 1) {
      return hasil;
    } else {
      for (var i = number; i >= 1; i--) {
        hasil *= i;
      }
      return hasil;
    }
  }
}

let number1 = 7;
let number2 = 4;

hasil1 = pemfaktoran(number1);
hasil2 = pemfaktoran(number2);

console.log("Faktorial dari " + number1 + " Memiliki hasil = " + hasil1);
console.log("Faktorial dari " + number2 + " Memiliki hasil = " + hasil2);

/*
Algoritma
1.Mulai 
2.angka input akan di proses oleh fungsi dengan ketentuan angka input haris >= 0 atau hasil aakan tidak terdifinisi
3.menghitung faktorial input angka dengan handlel error
4.cetak hasil pemfaktoran
*/
