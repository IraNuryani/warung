Dikarenakan sistem warung ini hanya memiliki konsep Model dan Controller, maka untuk menguji CRUD berjalan sesuai dengan yang diharapkan, maka sistem ini menggunakan bantuan respon dari API. 
Sistem ini memiliki 4 tabel, yaitu tabel Item Kategori, Item, Pembelian dan Penjualan. Item kategori memuat jenis-jenis kategori dari item, misal kategori 'Minuman', 'Makanan Ringan', 'Sembako', dll. Item kategori berelasi dengan tabel item, karena setiap item memiliki satu kategori sedangkan satu kategori bisa di miliki beberapa item. Kemudian tabel item memiliki relasi dengan pembelian dan penjualan.

Idenya adalah, ketika pemilik ingin menambah stok barang, maka akan melakukan pembelian, dimana pembelian item ini akan terhubung dengan item yang sudah ada di tabel item. Jika pemilik membeli suatu item, maka stok di tabel item otomatis akan bertambah sesuai dengan jumlah yang dibeli. Ketika data pembelian di edit, terutama mengedit bagian jumlah, stok di tabel item akan menyesuaikan. 

Penjualan juga hampir mirip seperti pembelian, perbedaannya adalah setiap ada transaksi jual maka stok di item akan berkurang sesuai dengan jumlah yang terjual. 