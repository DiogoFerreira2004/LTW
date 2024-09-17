<?php
declare(strict_types=1);

require_once (__DIR__ . '/../../database/book.class.php');

function drawProfile(User $user, array $booksForSale, Session $session)
{
    ?>
    <div class="profile-container">
        <div class="userInfoGeral">
            <img src="../images/user_uploads/<?= $user->profilePic ?>" class="userPicture">
            <div class="userInfo">
                <h1><?= $user->username ?></h1>
                <div class="nome">
                    <h3>Name:</h3>
                    <p><?= $user->name ?></p>
                </div>
            </div>
            <?php if ($session->getId() == $user->id) { ?>
                <a href="../pages/wishlist.php?username=<?= $session->getUsername() ?>"
                    class="messageMe"><button>Wishlist</button></a>
            <?php } ?>
        </div>

        <div class="sectionTitle">
            <h2>Library:</h2>
        </div>
        <hr>
        <section class="booksInCart">
            <div class="bookContainer">
                <?php if ($booksForSale) {
                    foreach ($booksForSale as $book) {
                        if ($book->isAvailable === 1) {
                            ?>
                            <article>
                                <a href="../pages/book.php?id=<?= $book->id ?>">
                                    <img src="../images/user_uploads/<?= $book->imagePath ?>">
                                    <p class="bookName"><?= $book->title ?></p>
                                    <p class="bookPrice"><?= $book->price ?>€</p>
                                </a>
                            </article>
                        <?php } else if ($book->isAvailable === 2) {
                            if ($session->getId() == $user->id) {
                                ?>
                                    <article>
                                        <img src="../images/user_uploads/<?= $book->imagePath ?>">
                                        <p class="bookName"><?= $book->title ?></p>
                                        <p>Sold!</p>
                                    </article>
                                <?php
                            }
                        }
                    }
                } else { ?>
                    <div class="noBooksColumn">
                        <img src="../images/no_books.png" alt="" height="300em">
                        <p>No books for sale!</p>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
<?php }

function drawEditProfile(Session $session, User $user)
{
    $messages = $session->getMessages();
    $mostRecentMessage = end($messages);

    ?>
    <div class="edit-profile-container">
        <div class="profileSection">
            <div class="sectionTitle">
                <h2>Edit Profile:</h2>
                <hr>
            </div>
            <h3 class="inputTitle">Change Profile Picture</h3>
            <form action="../actions/edit_profile/edit_profile_pic.action.php?username=<?= $user->username ?>" method="post"
                enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" name="image" id="image" accept=".png, .jpeg, .jpg" required>
                </div>
                <button type="submit" class="editButton">Change</button>
            </form>
            <h3 class="inputTitle">Change Name</h3>
            <form action="../actions/edit_profile/edit_name.action.php?username=<?= $user->username ?>" method="post">
                <div class="input-group">
                    <input type="text" name="name" placeholder="name" required>
                </div>
                <button type="submit" class="editButton">Edit</button>
            </form>
            <h3 class="inputTitle">Change Email</h3>
            <form action="../actions/edit_profile/edit_email.action.php?username=<?= $user->username ?>" method="post">
                <div class="input-group">
                    <input type="text" name="old_email" placeholder="current email" required>
                    <input type="text" name="new_email" placeholder="new email" required>
                </div>
                <button type="submit" class="editButton">Edit</button>

            </form>
            <h3 class="inputTitle">Change Username</h3>
            <form action="../actions/edit_profile/edit_username.action.php?username=<?= $user->username ?>" method="post">
                <div class="input-group">
                    <input type="text" name="username" placeholder="username" required>
                </div>
                <button type="submit" class="editButton">Edit</button>

            </form>
            <h3 class="inputTitle">Change Password</h3>
            <form action="../actions/edit_profile/edit_password.action.php?username=<?= $user->username ?>" method="post">
                <div class="input-group">
                    <input type="password" name="old_password" placeholder="current password" required>
                    <input type="password" name="new_password" placeholder="new password" required>
                    <input type="password" name="confirm_password" placeholder="confirm new password" required>
                </div>
                <button type="submit" class="editButton">Edit</button>
            </form>
        </div>
    </div>

    <?php if ($mostRecentMessage['type'] === 'success') { ?>
        <div class="success-message">
            <h3><?= $mostRecentMessage['text'] ?></h3>
        </div>
    <?php } else if ($mostRecentMessage['type'] === 'error') { ?>
            <div class="error-message">
                <h3><?= $mostRecentMessage['text'] ?></h3>
            </div>
    <?php }
} ?>