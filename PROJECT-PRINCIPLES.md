# Nasth Suite - Project Principles

1. **One Codebase to Rule Them All**  
   Semua klien menggunakan kode yang sama. Perbedaan fitur diatur melalui sistem lisensi modul di database, bukan percabangan kode (git branch per klien).

2. **Modular by Design**  
   Setiap modul baru harus independen dan tidak boleh merusak fungsi modul inti (Core).

3. **Solve Real Problems**  
   Jangan membuat fitur hanya karena terlihat keren di mata developer. Fitur harus lahir dari masalah nyata UMKM yang ditemukan oleh tim bisnis.

4. **Documentation Before Implementation**  
   Skema database dan kontrak API harus disepakati di folder `docs/` sebelum baris kode pertama ditulis.