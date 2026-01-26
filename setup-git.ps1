# Git Setup and Push Script
# This script will initialize the repository and prepare it for pushing to GitHub

Write-Host "Setting up Git repository..." -ForegroundColor Cyan

# Check if git is installed
try {
    $gitVersion = git --version 2>&1
    Write-Host "Git found: $gitVersion" -ForegroundColor Green
} catch {
    Write-Host "Git is not installed!" -ForegroundColor Red
    Write-Host "Please install Git from: https://git-scm.com/download/win" -ForegroundColor Yellow
    Write-Host "Or install via: winget install Git.Git" -ForegroundColor Yellow
    exit 1
}

# Initialize repository if not already initialized
if (-not (Test-Path .git)) {
    Write-Host "Initializing Git repository..." -ForegroundColor Cyan
    git init
} else {
    Write-Host "Git repository already initialized" -ForegroundColor Green
}

# Check current status
Write-Host ""
Write-Host "Current Git status:" -ForegroundColor Cyan
git status

# Add all files
Write-Host ""
Write-Host "Adding all files..." -ForegroundColor Cyan
git add .

# Create initial commit
Write-Host ""
Write-Host "Creating commit..." -ForegroundColor Cyan
git commit -m "Initial commit: Sistem Informasi PKL"

Write-Host ""
Write-Host "Repository initialized and ready!" -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Create a new repository on GitHub.com"
Write-Host "2. Then run these commands:"
Write-Host "   git remote add origin https://github.com/YOUR_USERNAME/REPO_NAME.git"
Write-Host "   git branch -M main"
Write-Host "   git push -u origin main"
