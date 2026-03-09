# 📋 Prosedur Kolaborasi Git - Landing Page Mieru

## 🎯 Tujuan
Memahami dan menerapkan workflow Git collaboration yang rapi untuk development project secara team-based. Semua perubahan HARUS melalui Pull Request (PR) dan di-review sebelum merge ke branch main.

---

## ⚠️ Aturan Utama
- ❌ **DILARANG** push langsung ke branch `main`
- ✅ Semua perubahan HARUS melalui PR dan review
- ✅ Setiap developer bekerja di branch terpisah
- ✅ Gunakan naming convention untuk branch yang jelas

---

## 📖 Step-by-Step Workflow

### 1️⃣ Clone Repository & Setup Lokal

```bash
# Clone repository
git clone https://github.com/rnlyone/Mieru-Next.git

# Masuk ke folder project
cd Mieru-Next

# Install dependencies
npm install
# atau
yarn install

# Pastikan berada di branch main
git checkout main

# Pull latest changes
git pull origin main

# Jalankan development server
npm run dev
# atau
yarn dev
```

**Akses aplikasi**: http://localhost:3000

---

### 2️⃣ Buat Branch Baru untuk Fitur

#### Format Penamaan Branch:
```
<tipe-update>/<deskripsi-update>
```

#### Contoh:
```bash
# Untuk feature baru
git checkout -b feature/contact-us-page

# Untuk bug fix
git checkout -b bugfix/navbar-responsive

# Untuk improvement
git checkout -b improvement/optimize-images

# Untuk dokumentasi
git checkout -b docs/git-workflow
```

#### Tipe-Tipe Branch:
| Tipe | Contoh | Deskripsi |
|------|--------|-----------|
| `feature/` | `feature/contact-us` | Menambah fitur baru |
| `bugfix/` | `bugfix/mobile-menu` | Memperbaiki bug |
| `improvement/` | `improvement/seo-optimization` | Perbaikan/optimasi |
| `docs/` | `docs/setup-guide` | Dokumentasi |
| `refactor/` | `refactor/component-structure` | Restructuring code |

**Perintah:**
```bash
git checkout -b feature/contact-us-page
```

---

### 3️⃣ Buat Perubahan Sesuai Task

#### Di Branch Lokal:
```bash
# Edit file yang diperlukan
# Buat component baru, update styling, dll

# Check status
git status

# Stage perubahan (cara umum)
git add .

# Atau stage file tertentu
git add src/components/ContactUs.tsx
```

#### Best Practices:
- 🔹 Buat perubahan yang fokus pada satu fitur
- 🔹 Hindari mengubah banyak hal di satu commit
- 🔹 Update files secara terstruktur

---

### 4️⃣ Commit Perubahan dengan Pesan yang Jelas

```bash
# Commit dengan pesan deskriptif
git commit -m "feat: add contact us page component"

# Contoh pesan commit yang baik
git commit -m "feat: implement email validation in contact form"
git commit -m "style: update contact form styling"
git commit -m "fix: prevent form double submission"
```

#### Format Pesan Commit:
```
<type>(<scope>): <subject>

<body (optional)>
```

#### Tipe Commit:
- `feat:` - Fitur baru
- `fix:` - Bug fix
- `style:` - Styling atau formatting
- `refactor:` - Refactoring code
- `docs:` - Dokumentasi
- `chore:` - Maintenance

---

### 5️⃣ Push ke Branch di Remote Repository

```bash
# Push branch ke remote
git push origin feature/contact-us-page

# Jika branch belum ada di remote
git push -u origin feature/contact-us-page
```

**Output yang diharapkan:**
```
Enumerating objects: X, done.
Counting objects: 100% (X/X), done.
...
To https://github.com/rnlyone/Mieru-Next.git
 * [new branch]      feature/contact-us-page -> feature/contact-us-page
Branch 'feature/contact-us-page' set up to track remote branch 'feature/contact-us-page'.
```

---

### 6️⃣ Buat Pull Request (PR) untuk Review

#### Di GitHub:

1. **Go to Repository** → https://github.com/rnlyone/Mieru-Next
2. **Klik tab "Pull requests"**
3. **Klik tombol "New pull request"** (atau ikuti link yang muncul setelah push)
4. **Compare branches:**
   - Base branch: `main`
   - Compare branch: `feature/contact-us-page`

#### Format PR Description:

```markdown
## 📝 Deskripsi Perubahan
Menjelaskan apa yang telah diubah dan mengapa.

## 🎯 Tujuan
- Menambahkan halaman Contact Us
- Form untuk menerima pesan dari user

## ✅ Checklist
- [x] Code sudah ditest
- [x] Following style guide/convention
- [x] Tidak ada console errors
- [x] Responsive design checked
- [x] Build successful

## 📸 Screenshots (jika ada UI changes)
Lampirkan screenshot fitur yang baru

## 🔗 Terkait dengan
Issue #XX (jika applicable)
```

5. **Add Reviewers** - Assign untuk di-review oleh team
6. **Create Pull Request** - Submit untuk review

---

### 7️⃣ Review & Merge Process

#### Sebagai Reviewer:
- Review code quality
- Check untuk bugs atau issues
- Request changes jika perlu
- Approve jika siap merge

#### Sebagai Developer:
- Respond to feedback
- Make requested changes
- Push updates ke branch yang sama
- PR akan auto-update

#### Merge ke Main:
```bash
# Setelah PR di-approve, klik "Merge pull request"
# Di GitHub pull request page
```

---

## 🔄 Update Branch Lokal dengan Main Terbaru

Jika ada perubahan di `main` dan Anda ingin update branch Anda:

```bash
# Fetch dari remote
git fetch origin

# Rebase branch Anda dengan main terbaru
git rebase origin/main

# Jika ada conflict, resolve dulu baru push
git push origin feature/contact-us-page --force-with-lease
```

---

## 🐛 Troubleshooting

### ❓ Lupa switch ke branch baru?
```bash
# Check branch mana yang active
git branch

# Switch ke branch yang tepat
git checkout feature/contact-us-page
```

### ❓ Ingin delete branch lokal?
```bash
git branch -d feature/contact-us-page
```

### ❓ Ingin delete branch di remote?
```bash
git push origin --delete feature/contact-us-page
```

### ❓ Lihat semua branch (lokal + remote)?
```bash
git branch -a
```

### ❓ Revert commits?
```bash
git reset HEAD~1  # Undo last commit (keep changes)
git reset --hard HEAD~1  # Undo last commit (discard changes)
```

---

## 📊 Git Collaboration Workflow Diagram

```
main (protected)
    ↓
[Pull latest main]
    ↓
feature/contact-us-page (lokal)
    ↓
[Make changes & commits]
    ↓
git push origin feature/contact-us-page
    ↓
Create Pull Request
    ↓
Code Review & Feedback
    ↓
[Make requested changes if needed]
    ↓
Approved by Reviewer
    ↓
Merge to main
    ↓
Delete branch
    ↓
Others: git pull origin main (untuk get latest)
```

---

## ✨ Best Practices Checklist

- ✅ Always pull latest `main` sebelum membuat branch baru
- ✅ Gunakan meaningful branch names
- ✅ Commit messages harus clear dan deskriptif
- ✅ Review code sendiri sebelum PR (check diff)
- ✅ Test fitur locally sebelum push
- ✅ Respond to feedback dengan cepat
- ✅ Keep commits logis dan focused
- ✅ Build successfully sebelum PR
- ✅ Update documentation jika diperlukan

---

## 📞 Referensi Cepat

```bash
# Clone repo
git clone https://github.com/rnlyone/Mieru-Next.git

# Setup lokal
cd Mieru-Next && npm install && npm run dev

# Buat branch baru
git checkout -b feature/nama-feature

# Commit & push
git add .
git commit -m "feat: deskripsi perubahan"
git push origin feature/nama-feature

# Update dengan main terbaru
git fetch origin && git rebase origin/main

# Lihat status
git status
git log --oneline
```

---

**Last Updated**: March 2026
