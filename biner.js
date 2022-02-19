function biner(number) {
  let result = "";
  for (var i = 0; number > 0; i++) {
    result = (number % 2) + result;
    if (number % 2 == 1) {
      number = (number - 1) / 2;
    } else if (number % 2 == 0) {
      number = number / 2;
    }
  }
  return result;
}
let angka1 = 29;
let angka2 = 12;
let hasil = biner(angka1);
let hasil2 = biner(angka2);

console.log("Hasil Biner dari " + angka1);
console.log(hasil);

console.log("Hasil Biner dari " + angka2);
console.log(hasil2);
/*
Algoritma
1.Mulai 
2.angka input akan di proses oleh fungsi dengan kondisi angka input lebih besar dari 0
3.menghitung hasil bagi input angka dengan handlel error
4.hasil hitung di masukan kedalam string
5. cetak hasil string biner
*/
