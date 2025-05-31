import { link } from './link.js';

export function get() {
    console.log("Get function triggered");
    link.get('/pelanggan')
        .then(res => {
            let tampil = `<table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                </tr>`;

            res.data.forEach(el => {
                tampil += `
                    <tr>
                        <td>${el.idpelanggan}</td>
                        <td>${el.pelanggan}</td>
                        <td>${el.alamat}</td>
                        <td>${el.telp}</td>
                    </tr>`;
            });

            tampil += '</table>';
            document.getElementById("out").innerHTML = tampil;
        })
        .catch(err => {
            console.error(err);
            document.getElementById("out").innerHTML = `<div class="alert alert-danger">Gagal mengambil data</div>`;
        });
}
