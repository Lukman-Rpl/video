import ListSiswa from './ListSiswa';

function Siswa() {
    const array = ["Siswa 1", "Siswa 2", "Siswa 3"]; // Contoh array judul

    return (
        <div className="Kontak">
            <ListSiswa judul={array} />
        </div>
    );
}

export default Siswa;