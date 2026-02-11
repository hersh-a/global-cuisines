# 🌍 Global Cuisine – CodeIgniter MVC Application

## Overview

Global Cuisine is a project I did with full MVC web application built using the **CodeIgniter framework**.  
This project demonstrates CRUD operations, authentication with Ion Auth, relational database implementation, image upload and resizing, and proper application security.

Users can browse cuisine articles from around the world. Registered users can create, edit, and delete their own articles, while guests can view all published content.

---

## Technologies Used

- PHP
- CodeIgniter (MVC Framework)
- MySQL
- Ion Auth Authentication Library
- HTML / CSS (Custom Styling)
- Bootstrap

---

## ✅ Part 1 – Articles Section (CRUD)

A fully functional **Articles controller** was created to handle:

- Displaying all articles (set as default controller)
- Viewing full article details
- Creating new articles
- Editing existing articles
- Deleting articles

### Features Implemented

- Homepage displays:
  - Article title
  - Truncated preview of content
  - Thumbnail image (if uploaded)
  - "Read More" link
- Full article page displays:
  - Title
  - Full content (with proper line breaks)
  - Author name
  - Formatted date and time created
  - Larger image version (if uploaded)
- Server-side form validation
- Multiple articles with several paragraphs of content

---

## 🔐 Part 2 – Ion Auth Integration & Relational Database

Ion Auth was integrated for authentication and authorization.

### Authentication Features

- User registration
- User login/logout
- Protected routes for:
  - Writing articles
  - Editing articles
  - Deleting articles
- Guests can read articles but cannot modify content

### Authorization Rules

- Authors can edit/delete **only their own articles**
- Ownership is verified using a `check_owner` function
- Protection against URL ID manipulation
- `user_id` stored in the `articles` table
- JOIN query used to display the author’s username on each article

### Test User for Instructor

- **Username:** philr  
- **Email:** philr@nait.ca  
- **Password:** webweb123  

---

## 🏆 Challenges Completed

### 📷 Image Upload & Resize

- Articles can include an uploaded image
- File type and size validation implemented
- Two image sizes generated:
  - Thumbnail (article list page)
  - Larger version (full article page)
- Images stored in:
  - `/uploads`
  - `/pictures`
  - `/pictures/thumbs`
- `base_url()` used for absolute image paths

---

### 🔒 Application Security

- Edit/Delete buttons visible only to article owners
- Ownership verified before allowing modifications
- Unauthorized URL manipulation safely redirected
- Ion Auth autoloaded for consistent authentication checks

---

### 🔽 Dynamic Login Dropdown Menu

- If not logged in:
  - Displays Login link
- If logged in:
  - Displays “Logged in as {username}”
  - Logout option
  - Write Article option

---

## 👩‍💻 Author
Developed by Hershey Agustin 
- Global Cuisine MVC Project  
- CodeIgniter + Ion Auth Implementation
