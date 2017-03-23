function nowmulai() {
  nowDate = moment().tz("Asia/Jakarta").format('YYYY-MM-DD');
  document.getElementById('tanggal-mulai').value = nowDate;
}

function nowselesai() {
  nowDate = moment().tz("Asia/Jakarta").format('YYYY-MM-DD');
  document.getElementById('tanggal-selesai').value = nowDate;
}

function stopNow() {
  clearTimeout(set);
}
