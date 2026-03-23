# GitHub Versioning Guide

The task requires all work to be stored as different versions in one GitHub repository.

## Recommended workflow

```bash
git init
git add .
git commit -m "Initial repository structure"

git add v1-session
git commit -m "Version 1 - session based user management system"

git add v2-database
git commit -m "Version 2 - user management system with database storage"

git tag v1-session <commit_of_version_1>
git tag v2-database <commit_of_version_2>

git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPOSITORY.git
git branch -M main
git push -u origin main --tags
```

## What to submit

1. GitHub repository containing both versions.
2. PDF report with the GitHub repository URL.
3. Screenshots or test evidence inside the PDF report.

