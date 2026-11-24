<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    books: Object,
    search: String,
});

// Langkah 8: Nilai awal kotak pencarian diisi dari props.search
const keyword = ref(props.search);

// Langkah 8: Kirim query string ?search=... saat menekan Enter
function cari() {
    router.get('/books', { search: keyword.value });
}

// Langkah 6: Konfirmasi sebelum menghapus data lalu kirim request DELETE
function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <h1>Data Buku</h1>

        <!-- Langkah 6: Menampilkan flash message dari Langkah 5 -->
        <div v-if="$page.props.flash.success">
            {{ $page.props.flash.success }}
        </div>

        <Link href="/books/create">+ Tambah Buku</Link>

        <!-- Langkah 8: Kotak pencarian di atas tabel -->
        <input
            v-model="keyword"
            @keyup.enter="cari"
            type="text"
            placeholder="Cari judul atau pengarang..."
        >

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books.data" :key="book.id">
                    <td>{{ book.kode_buku }}</td>
                    <td>{{ book.judul }}</td>
                    <td>{{ book.pengarang }}</td>
                    <td>{{ book.tahun }}</td>
                    <td>{{ book.stok }}</td>
                    <td>
                        <!-- Langkah 6: Tombol Edit dan Hapus -->
                        <Link :href="`/books/${book.id}/edit`">Edit</Link>
                        <button @click="hapus(book.id)">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>