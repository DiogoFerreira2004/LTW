# ShelfSwap

## ltw15g08:

1. Diogo Ferreira - E-mail: up202205295@edu.fe.up.pt
2. Gabriel Carvalho - E-mail: up202208939@edu.fe.up.pt

## Install instructions:

> git clone git@github.com:FEUP-LTW-2024/ltw-project-2024-ltw15g08.git
> git checkout final-delivery-v1
> sqlite3 -init database.sql database.db
> php -S localhost:9000

After this, the code should be able to run.
<br><br>
**Warning:** You might need to install sqlite3 if you haven't so already!

## Screenshots

### Login
<img src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g08/blob/4958062bd47532c36bb8d52f12abf728c5b18c2e/docs/login_preview.png">

### Home
<img src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g08/blob/4958062bd47532c36bb8d52f12abf728c5b18c2e/docs/home_preview.png">

### Profile
<img src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g08/blob/4958062bd47532c36bb8d52f12abf728c5b18c2e/docs/profile_preview.png">

## Implemented Features

**General**:

- [x] Register a new account.
- [x] Log in and out.
- [x] Edit their profile, including their name, username, password, and email.


**Sellers**  should be able to:

- [x] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [x] Track and manage their listed items.
- [x] Respond to inquiries from buyers regarding their items and add further information if needed.
- [x] Print shipping forms for items that have been sold.


**Buyers**  should be able to:

- [x] Browse items using filters like category, price, and condition.
- [x] Engage with sellers to ask questions or negotiate prices.
- [x] Add items to a wishlist or shopping cart.
- [x] Proceed to checkout with their shopping cart (simulate payment process).


**Admins**  should be able to:

- [x] Elevate a user to admin status.
- [x] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [x] Oversee and ensure the smooth operation of the entire system.


**Security**:
We have been careful with the following security aspects:

- [x] **SQL injection**
- [x] **Cross-Site Scripting (XSS)**
- [x] **Cross-Site Request Forgery (CSRF)**


**Password Storage Mechanism**: md5 / sha1 / sha256 / hash_password&verify_password

**Aditional Requirements**:

We also implemented the following additional requirements (you can add more):

- [ ] **Rating and Review System**
- [ ] **Promotional Features**
- [ ] **Analytics Dashboard**
- [ ] **Multi-Currency Support**
- [x] **Item Swapping**
- [ ] **API Integration**
- [ ] **Dynamic Promotions**
- [ ] **User Preferences**
- [ ] **Shipping Costs**
- [ ] **Real-Time Messaging System**
