# Online Voting System

A secure, web-based platform designed to streamline the election process by enabling users to register, log in, and cast votes for candidate groups. This project utilizes a clean interface and a reliable backend to ensure accurate, real-time result tracking.

## Features
* **User Authentication:** Secure registration and login system with role-based access for Voters and Groups.
* **Real-time Voting:** Once a voter casts their ballot, the system updates the group's vote count and restricts the user from voting again.
* **Dynamic Dashboard:** Provides users with a profile overview and a list of available groups to vote for.
* **Results Visualization:** A dedicated results page displays the current leader and a bar-chart breakdown of vote percentages for each group.
* **Database Integration:** Efficient data handling using MySQL to manage users, votes, and candidate information.

## Technologies Used
* **Frontend:** HTML5, CSS3 (with responsive layout designs).
* **Backend:** PHP (for server-side logic and session management).
* **Database:** MySQL (XAMPP/WAMP environment).
* **Automation:** Python script provided for administrative result reporting.

## Installation & Setup
1.  **Environment:** Ensure you have a local server environment (such as XAMPP or WAMP) running.
2.  **Database:** Create a database named `myproject` and import the necessary user table structure.
3.  **Deployment:** Place the project files into your server's root directory (e.g., `htdocs`).
4.  **Configuration:** Update the database credentials in `api/connect.php` if your local environment requires specific settings.
5.  **Access:** Open your browser and navigate to the `index.html` file to begin using the system.

## Project Structure
* `api/`: Contains backend logic for registration, login, and voting processes.
* `project/`: Contains the primary interface files (Dashboard, Registration, Results).
* `css/`: Contains styling sheets for the application.
* `uploads/`: Directory for storing user profile and candidate images.
