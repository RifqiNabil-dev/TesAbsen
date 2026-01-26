# Git Setup Guide

## 📦 Install Git

Git is not currently installed on your system. Here's how to install it:

### Option 1: Download Git for Windows (Recommended)
1. Download from: https://git-scm.com/download/win
2. Run the installer
3. Use default settings (recommended)
4. Restart your terminal/PowerShell after installation

### Option 2: Install via Winget (if available)
```powershell
winget install Git.Git
```

### Option 3: Install via Chocolatey (if you have it)
```powershell
choco install git
```

---

## 🚀 Initialize and Push to GitHub

After installing Git, follow these steps:

### Step 1: Initialize Git Repository
```bash
git init
```

### Step 2: Add All Files
```bash
git add .
```

### Step 3: Create Initial Commit
```bash
git commit -m "Initial commit: Sistem Informasi PKL"
```

### Step 4: Create Repository on GitHub
1. Go to [github.com](https://github.com)
2. Click **"New repository"**
3. Name it (e.g., `Sistem_Magang` or `sistem-pkl`)
4. **Don't** initialize with README (you already have one)
5. Click **"Create repository"**

### Step 5: Add Remote and Push
```bash
# Replace YOUR_USERNAME and REPO_NAME with your actual values
git remote add origin https://github.com/YOUR_USERNAME/REPO_NAME.git
git branch -M main
git push -u origin main
```

---

## 🔐 GitHub Authentication

If you encounter authentication issues:

### Option 1: Use GitHub CLI
```bash
# Install GitHub CLI first, then:
gh auth login
```

### Option 2: Use Personal Access Token
1. Go to GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Generate new token with `repo` permissions
3. Use token as password when pushing

### Option 3: Use SSH (Recommended for long-term)
```bash
# Generate SSH key
ssh-keygen -t ed25519 -C "your_email@example.com"

# Add to GitHub (Settings → SSH and GPG keys)
# Then use SSH URL:
git remote set-url origin git@github.com:YOUR_USERNAME/REPO_NAME.git
```

---

## ✅ Quick Checklist

- [ ] Git installed
- [ ] GitHub account created
- [ ] Repository initialized (`git init`)
- [ ] Files added (`git add .`)
- [ ] Initial commit made
- [ ] GitHub repository created
- [ ] Remote added
- [ ] Code pushed to GitHub

---

## 📝 Alternative: Use GitHub Desktop

If you prefer a GUI:
1. Download [GitHub Desktop](https://desktop.github.com/)
2. Sign in with GitHub account
3. File → Add Local Repository
4. Select this folder
5. Publish repository to GitHub

---

**After setting up Git and pushing, you'll be ready to deploy to Laravel Cloud!**
