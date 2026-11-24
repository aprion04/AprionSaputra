<table>
    <thead>
        <tr>
            <th>Kode</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="book in books.data" :key="book.id">
            <td>{{ book.kode_buku }}</td>
            <td>{{ book.judul }}</td>
            <td>{{ book.pengarang }}</td>
            <td>{{ book.tahun }}</td>
            <td>{{ book.stok }}</td>
        </tr>
    </tbody>
</table>