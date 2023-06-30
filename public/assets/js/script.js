$(document).ready(function(){
    $(document).on('click','a[data-role=edit]', function(){
        var id = $(this).data('id');
        var pengadaan = $('#'+id).children('td[data-target=pengadaan]').text();
        var jenispengadaan = $('#'+id).children('td[data-target=jenispengadaan]').text();
        var ppk = $('#'+id).children('td[data-target=ppk]').text();
        var penyedia = $('#'+id).children('td[data-target=penyedia]').text();
        var nokontrak = $('#'+id).children('td[data-target=nokontrak]').text();
        var tglkontrak = $('#'+id).children('td[data-target=tglkontrak]').text();
        var akhirkontrak = $('#'+id).children('td[data-target=akhirkontrak]').text();
        var pagu = $('#'+id).children('td[data-target=pagu]').text().trim();
        var nilaikontrak = $('#'+id).children('td[data-target=nilaikontrak]').text().trim();
        var uangmuka = $('#'+id).children('td[data-target=uangmuka]').text().trim();
        var tahap1 = $('#'+id).children('td[data-target=tahap1]').text().trim();
        var tahap2 = $('#'+id).children('td[data-target=tahap2]').text().trim();
        var pelunasan = $('#'+id).children('td[data-target=pelunasan]').text().trim();
        var jumin = $('#'+id).children('td[data-target=jumin]').text().trim();
        var tkdn = $('#'+id).children('td[data-target=tkdn]').text().trim();
        var ket = $('#'+id).children('td[data-target=ket]').text();

        // var paguValue = pagu.replace(/\./g, '');
        // var nilaikontrakValue = nilaikontrak.replace(/\./g, '');
        // var uangmukaValue = uangmuka.replace(/\./g, '');
        // var tahap1Value = tahap1.replace(/\./g, '');
        // var tahap2Value = tahap2.replace(/\./g, '');
        // var pelunasanValue = pelunasan.replace(/\./g, '');
        var juminValue = jumin.replace(/\%/g, '');
        var tkdnValue = tkdn.replace(/\%/g, '');

        var optionValue = '';
        switch (jenispengadaan) {
          case 'Konsultansi':
            optionValue = '1';
            break;
          case 'Konstruksi':
            optionValue = '2';
            break;
          case 'Barang':
            optionValue = '3';
            break;
          case 'Jasa Lainnya':
            optionValue = '4';
            break;
          default:
            optionValue = ''; // Set the default value if needed
            break;
        }


        $('#id').val(id);
        $('#pengadaan').val(pengadaan);
        $('#jenispengadaan').val(optionValue);
        $('#ppk').val(ppk);
        $('#penyedia').val(penyedia);
        $('#nokontrak').val(nokontrak);
        $('#tglkontrak').val(tglkontrak);
        $('#akhirkontrak').val(akhirkontrak);
        $('#pagu').val(pagu);
        $('#nilaikontrak').val(nilaikontrak);
        $('#uangmuka').val(uangmuka);
        $('#tahap1').val(tahap1);
        $('#tahap2').val(tahap2);
        $('#pelunasan').val(pelunasan);
        $('#jumin').val(juminValue);
        $('#tkdn').val(tkdnValue);
        $('#ket').val(ket);
        $('#full-width-modal').modal('toggle');

    })
})

// $(document).ready(function() {
//     $('.input-field').on('input', function() {
//       var persenuangmuka = $('#persenuangmuka').val();
//       var nilaikontrak = $('#nilaikontrak').val();
      
//       // Remove commas from the string
//         var cleanedValue = nilaikontrak.replace(/,/g, '');
//       // Convert the cleaned string into a number
//         var numberValue = parseFloat(cleanedValue);

//         if (isNaN(numberValue)) {
//             numberValue = 0;
//             }

//         var result = numberValue * (persenuangmuka / 100);

//         // Format the result with a thousands separator
//         var formattedResult = result.toLocaleString();

//         $('#uangmuka').val(formattedResult);

//     });
//   });

  // $(document).ready(function() {
  //   $('.input-field').on('input', function() {
  //     var pagu = $('#pagu').val();
  //     var nilaikontrak = $('#nilaikontrak').val();
      
  //     // Remove commas from the string
  //       var cleanednilaikontrak = nilaikontrak.replace(/,/g, '');
  //       var cleanedpagu = pagu.replace(/,/g, '');
  //     // Convert the cleaned string into a number
  //       var numbernilaikontrak = parseFloat(cleanednilaikontrak);
  //       var numberpagu = parseFloat(cleanedpagu);

  //       if (isNaN(numbernilaikontrak)) {
  //           numbernilaikontrak = 0;
  //           }

  //       if (isNaN(numberpagu)) {
  //           numberpagu = 0;
  //           }

  //       var result = numberpagu - numbernilaikontrak;

  //       // Format the result with a thousands separator
  //       var formattedResult = result.toLocaleString();

  //       $('#sisapagu').val(formattedResult);

  //   });
  // });

  // $(document).ready(function() {
  //   $('.input-field').on('input', function() {
  //       var nilaikontrak = $('#nilaikontrak').val();
  //       var uangmuka = $('#uangmuka').val();
  //       var tahap1 = $('#tahap1').val();
  //       var tahap2 = $('#tahap2').val();
  //       var pelunasan = $('#pelunasan').val();
      
  //     // Remove commas from the string
  //       var cleanedNilaiKontrak = nilaikontrak.replace(/,/g, '');
  //       var cleaneduangmuka = uangmuka.replace(/,/g, '');
  //       var cleanedtahap1 = tahap1.replace(/,/g, '');
  //       var cleanedtahap2 = tahap2.replace(/,/g, '');
  //       var cleanedpelunasan = pelunasan.replace(/,/g, '');
  //     // Convert the cleaned string into a number
  //       var nilaiKontrakValue = parseFloat(cleanedNilaiKontrak);
  //       var uangmukaValue = parseFloat(cleaneduangmuka);
  //       var tahap1Value = parseFloat(cleanedtahap1);
  //       var tahap2Value = parseFloat(cleanedtahap2);
  //       var pelunasanValue = parseFloat(cleanedpelunasan);

  //       // Check if any of the variables is NaN (null value)
  //       if (isNaN(nilaiKontrakValue)) {
  //           nilaiKontrakValue = 0;
  //       }
  //       if (isNaN(uangmukaValue)) {
  //       uangmukaValue = 0;
  //       }
  //       if (isNaN(tahap1Value)) {
  //       tahap1Value = 0;
  //       }
  //       if (isNaN(tahap2Value)) {
  //       tahap2Value = 0;
  //       }
  //       if (isNaN(pelunasanValue)) {
  //       pelunasanValue = 0;
  //       }

  //       var result = nilaiKontrakValue - (uangmukaValue + tahap1Value + tahap2Value + pelunasanValue)
  //       var formattedResult = result.toLocaleString();

  //       $('#sisaanggaran').val(formattedResult);

  //   });
  // });

// Retrieve input elements by their IDs
const paguInput = document.getElementById('pagu');
const nilaikontrakInput = document.getElementById('nilaikontrak');
const nilaikontrakInput2 = document.getElementById('nilaikontrak');
const sisapaguInput = document.getElementById('sisapagu');
const uangmukaInput = document.getElementById('uangmuka');
const tahap1Input = document.getElementById('tahap1');
const tahap2Input = document.getElementById('tahap2');
const pelunasanInput = document.getElementById('pelunasan');
const sisaanggaranInput = document.getElementById('sisaanggaran');
// Function to parse the input value and convert it to a number
function parseNumber(value) {
  return parseFloat(value.replace(/\./g, '').replace(',', '.'));
}

// Function to format the number with thousand separators and decimal separator
function formatNumber(value) {
  const [integerPart, decimalPart] = value.toFixed(2).split('.');
  const formattedIntegerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  return `${formattedIntegerPart},${decimalPart}`;
}

// Function to calculate and update the 'sisapagu' value
function calculateSisapagu() {
  const paguValue = parseNumber(paguInput.value);
  const nilaikontrakValue = parseNumber(nilaikontrakInput.value);

  const sanitizedPaguValue = isNaN(paguValue) || paguValue === null ? 0 : paguValue;
  const sanitizedNilaikontrakValue = isNaN(nilaikontrakValue) || nilaikontrakValue === null ? 0 : nilaikontrakValue;

  const sisapaguValue = sanitizedPaguValue - sanitizedNilaikontrakValue;

  // Set the calculated value in 'sisapagu' input field with the desired formatting
  sisapaguInput.value = formatNumber(sisapaguValue);
}

// Function to calculate and update the 'sisaanggaran' value
function calculateSisaanggaran() {
  const nilaikontrakValue = parseNumber(nilaikontrakInput.value);
  const uangmukaValue = parseNumber(uangmukaInput.value);
  const tahap1Value = parseNumber(tahap1Input.value);
  const tahap2Value = parseNumber(tahap2Input.value);
  const pelunasanValue = parseNumber(pelunasanInput.value);

  // Set NaN or null values to 0
  const sanitizedNilaikontrakValue = isNaN(nilaikontrakValue) || nilaikontrakValue === null ? 0 : nilaikontrakValue;
  const sanitizedUangmukaValue = isNaN(uangmukaValue) || uangmukaValue === null ? 0 : uangmukaValue;
  const sanitizedTahap1Value = isNaN(tahap1Value) || tahap1Value === null ? 0 : tahap1Value;
  const sanitizedTahap2Value = isNaN(tahap2Value) || tahap2Value === null ? 0 : tahap2Value;
  const sanitizedPelunasanValue = isNaN(pelunasanValue) || pelunasanValue === null ? 0 : pelunasanValue;

  const sisaanggaranValue = sanitizedNilaikontrakValue - (sanitizedUangmukaValue + sanitizedTahap1Value + sanitizedTahap2Value + sanitizedPelunasanValue);

  // Set the calculated value in 'sisaanggaran' input field with the desired formatting
  sisaanggaranInput.value = formatNumber(sisaanggaranValue);
}

// Event listeners to trigger the calculation when 'pagu' or 'nilaikontrak' values change
paguInput.addEventListener('input', calculateSisapagu);
nilaikontrakInput.addEventListener('input', calculateSisapagu);
nilaikontrakInput2.addEventListener('input', calculateSisaanggaran);
uangmukaInput.addEventListener('input', calculateSisaanggaran);
tahap1Input.addEventListener('input', calculateSisaanggaran);
tahap2Input.addEventListener('input', calculateSisaanggaran);
pelunasanInput.addEventListener('input', calculateSisaanggaran);



