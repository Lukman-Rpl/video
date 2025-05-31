function Tabel(props) {
    const menus = props.menu;
    const titel = props.titel;

    return (
        <div className="Kontak">
            <h1>{titel}</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    {menus.map((data) => (
                        <tr key={data.idmenu}>
                            <td>{data.menu}</td>
                            <td>{data.harga}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Tabel;
