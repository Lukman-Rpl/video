function ListSiswa({ judul }) {
    const siswa = judul.map((item, i) => (
        <li key={i}>{item}</li>
    ));

    return (
        <ul>
            {siswa}
        </ul>
    );
}

export default ListSiswa;