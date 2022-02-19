let abjad = "abcdefghijklmnopqrstuvwxyz";
let abjadList = abjad.split("");
console.log(abjadList);

function penjumlahanAbjad(text) {
  let jumlah = 0;
  let result = "";
  textList = text.toLowerCase().split("");
  textList.forEach((element) => {
    for (let i = 0; i < abjadList.length; i++) {
      if (element == abjadList[i]) {
        jumlah = jumlah + i + 1;
        result = result + " + " + (i + 1);
      }
    }
  });

  return result.substring(3) + " = " + jumlah;
}

//input
let text = "pagi";
let hasil = penjumlahanAbjad(text);
console.log(hasil);

/*
Algoritma
1. Mulai 
2. menyiapkan susunan abjad yang di split kedalam array.
3. Melakukan perhitungan pada fungsi dengan text yang di input
4. fungsi akan pencari huruh huruh yang di masukan terdapat pada index keberapa, dan kemudian menjumlahkan index
5. cetak hasil perhitungan
*/
