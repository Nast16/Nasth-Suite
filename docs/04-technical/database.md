Organizations (Klien Bisnis)
 ├── id (PK)
 ├── name (Nama UMKM)
 └── type (Coffee shop / Laundry / dll)

Users (Pengguna di dalam UMKM)
 ├── id (PK)
 ├── organization_id (FK to Organizations)
 ├── name
 ├── email
 └── password

Modules (Daftar Modul Global)
 ├── id (PK)
 ├── name (Cashbook, Inventory, Task)
 └── slug

Organization_Modules (Tabel Kontrol Modular)
 ├── organization_id (FK to Organizations)
 └── module_id (FK to Modules)