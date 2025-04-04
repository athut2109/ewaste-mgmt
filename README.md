
# E-Waste Management Service

Welcome to the E-Waste Management Service repository! This project aims to provide a platform for managing electronic waste efficiently. Users can register, login, edit their profiles, and most importantly, add or remove e-waste items from the item list.

## Features

- **User Registration and Login**: Users can sign up for an account and log in securely.
- **Profile Editing**: Users have the ability to edit their profiles to update their information.
- **E-Waste Item Management**: The main feature of this service is the ability to add new e-waste items to the list or remove existing ones.

## Installation

1. Clone this repository to your local machine:

    `git clone https://github.com/athut2109/ewaste-mgmt.git`


2. Ensure you have XAMPP installed on your machine. If not, download and install it from [here](https://www.apachefriends.org/index.html).

3. Start Apache and MySQL modules in XAMPP.

4. Navigate to the `htdocs` directory in your XAMPP installation directory. This directory is where you store your web files.

5. Move the cloned repository folder `ewaste-mgmt` into the `htdocs` directory.

6. Open phpMyAdmin in your browser by visiting `http://localhost/phpmyadmin`.

7. Create a new database, for example - `e_waste_management`.

8. Import the provided SQL file `ewaste-mgmt.sql` present in the cloned repository into the newly created database (here it is `e_waste_management` database).

## Usage

1. Open your web browser and navigate to `http://localhost/e-waste-management` to access the application.

2. Register for an account if you are a new user, or log in if you already have an account.

3. Once logged in, you can navigate through the application to manage e-waste items and edit your profile.

4. Since the database is hosted locally on XAMPP, only users on your local machine will be able to access and interact with the application.

## Upcoming Changes/Features

1. **UI/UX Improvements**: We are working on making the entire site more user-friendly and visually appealing. Expect to see enhancements in layout, color schemes, and overall design to provide a smoother and more enjoyable user experience.

2. **Progress Bar for Total Weight**: A progress bar will be added to keep track of the total weight of the e-waste item list. This feature will provide users with a visual representation of their environmental impact and encourage responsible disposal practices.

3. **Notification System**: Stay informed about important updates, such as account activity, item status changes, or system maintenance, through a notification system. Notifications will be displayed in real-time to keep users informed and engaged with the platform.

4. **Integration with External APIs**: We aim to integrate with external APIs to provide additional functionalities, such as calculating carbon footprint based on disposed items, locating nearby e-waste recycling centers, or offering eco-friendly disposal options.

5. **Item History**: Keep track of all changes made to e-waste items with the new item history feature. Users will be able to view a detailed log of modifications, including additions, removals, and updates, ensuring transparency and accountability in the management process.

6. **Feedback Mechanism**: We value your input and want to hear your feedback! We will be implementing a feedback mechanism where users can provide suggestions, report issues, or share their experiences to help us improve the service continuously.

**and many more!**

## Contact

If you have any questions or suggestions regarding this project, feel free to contact us at [atharvat.code@gmail.com](mailto:atharvat.code@gmail.com).

Thank you for using our E-Waste Management Service!
