# Project Styling Guide

---

## 1. Project Structure

Struktur penting terkait styling:

```
public/
 ├─ assets/
 │   ├─ css/
 │   │   └─ style.css
 │   ├─ js/
 │   ├─ imgs/
 │   ├─ fonts/
 │   └─ vendor/
 │
 ├─ index.html
 └─ send-email.php
```

### Entry Point

Halaman utama:

```
public/index.html
```

Semua layout utama diedit di file ini.

### Main Stylesheet

Semua styling utama ada di:

```
public/assets/css/style﹖v=1.0.css
```

File ini berisi:

- global styling
- component styling
- page-specific styling

---

## 2. CSS Architecture

CSS dalam project ini disusun dalam beberapa bagian besar.

Urutan utama di dalam file:

1. Variables
2. Typography
3. Animations
4. Global styles
5. Theme styles
6. Components
7. Page-specific styles

---

## 3. Design Tokens (CSS Variables)

Semua warna utama menggunakan **CSS variables** yang didefinisikan di `:root`.

Contoh konsep:

```
:root
 ├ primary
 ├ secondary
 ├ theme
 ├ border
 ├ bg
 ├ black
 ├ white
```

### Color Roles

| Token | Role |
| --- | --- |
| primary | warna teks utama |
| secondary | warna teks sekunder |
| theme | warna aksen utama |
| border | warna border |
| bg | background utama |
| black | warna hitam dasar |
| white | warna putih dasar |

### Dark Mode

Dark mode menggunakan override variables melalui class `.dark`.

---

## 4. Typography

Font utama diimport dari **Google Fonts**.

Font yang digunakan:

- DM Sans
- Instrument Sans
- Oswald
- Hind Madurai
- Plus Jakarta Sans

### General Typography Rules

Heading biasanya menggunakan:

```
Oswald
atau
Instrument Sans
```

Body text biasanya menggunakan:

```
DM Sans
atau
Plus Jakarta Sans
```

---
## 5. Layout System

Layout mengikuti pola **section-based design**.

Contoh struktur HTML umum:

```
section
  container
    row
      column
```

Framework grid mengikuti konsep seperti **Bootstrap grid**.

Contoh:

```
.container
.row
.col-lg-6
.col-md-6
```

Spacing biasanya dikontrol melalui:

- padding section
- margin utilities
- gap pada flex/grid

---

## 6. Global Styling Rules

Global rules mencakup:

- reset styles
- body typography
- default link behavior
- container width
- spacing

Beberapa prinsip:

### 1. Section spacing

Section biasanya memiliki padding vertikal.

Contoh konsep:

```
section {
  padding-top
  padding-bottom
}
```

### 2. Flex usage

Layout modern menggunakan:

```
display: flex
gap
align-items
justify-content
```

### 3. Hover transitions

Animasi hover menggunakan transisi pendek:

```
transition: 0.2s – 0.4s
ease / ease-in-out
```

---

## 7. Component Styling

Styling juga dipisahkan berdasarkan **komponen UI**.

Contoh kategori komponen:

### Buttons

Komponen button biasanya memiliki:

- primary button
- outline button
- animated button

Pattern umum:

```
.btn
.btn-primary
.btn-outline
```

---

### Navigation / Menu

Menu biasanya mencakup:

```
header
navbar
dropdown
mobile menu
```

Interaksi menu sering menggunakan:

- hover dropdown
- mobile toggle
- sticky header

---

### Cursor

Template ini memiliki custom cursor effect.

Biasanya melibatkan:

```
cursor wrapper
cursor dot
cursor animation
```

---

### Modal

Modal styling mencakup:

- overlay
- modal container
- modal animation

---

## 8. Animation System

Animasi biasanya digunakan untuk:

- hover interaction
- scroll animation
- button effects
- cursor movement

Durasi animasi biasanya:

```
0.2s
0.3s
0.4s
```

Timing function yang sering dipakai:

```
ease
ease-in-out
```

---

## 9. Page-Based Styling

CSS juga dikelompokkan berdasarkan **halaman**.

Contoh section CSS dalam file:

```
digital agency page css
design agency page css
creative agency page css
marketing agency page css
startup agency page css
portfolio page css
blog page css
contact page css
about page css
faq page css
```

Ini berarti styling tertentu hanya berlaku untuk halaman tertentu.

---

## 10. Naming Convention

Class naming mengikuti pola **descriptive naming**.

Contoh:

```
hero-section
portfolio-item
team-card
service-box
contact-form
social-icons
```

Hindari:

```
class1
box2
style3
```

---

## 11. Responsive Design

Responsive design menggunakan media queries.

Breakpoints utama:

```
1200px
992px
768px
575px
```

Contoh penggunaan:

```
@media (max-width: 575px)
```

Biasanya untuk:

- resize typography
- stack layout
- resize icons
- adjust spacing

---

## 12. Editing Guidelines

Saat memodifikasi UI:

### HTML changes

Edit di:

```
public/index.html
```

### CSS changes

Tambahkan atau edit di:

```
public/assets/css/style﹖v=1.0.css
```

Ikuti urutan section CSS yang sudah ada.

Jangan menaruh style secara acak.

---

## 13. Editing Rules

1. Jangan mengubah CSS variables tanpa alasan kuat.
2. Gunakan class yang sudah ada jika memungkinkan.
3. Tambahkan style di section CSS yang relevan.
4. Hindari inline styles.
5. Gunakan naming convention yang konsisten.

---

## 14. Recommended Workflow

Jika ingin menambahkan UI baru:

1. Tambahkan HTML di `index.html`
2. Buat class baru yang deskriptif
3. Tambahkan styling di section CSS terkait
4. Tambahkan responsive rule jika diperlukan