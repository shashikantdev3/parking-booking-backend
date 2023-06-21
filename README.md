# Parking Booking Backend

The Parking Booking Backend repository contains the backend codebase for the Parking Booking website, which handles server-side logic, database operations, and API endpoints for the parking booking system.

## Features

- User Management: Provides user registration, login, and authentication functionalities.
- Parking Space Management: Allows the creation, retrieval, update, and deletion of parking spaces.
- Booking Management: Handles the creation, retrieval, update, and cancellation of parking bookings.
- Database Integration: Utilizes MySQL as the relational database management system for data storage.

## Technologies Used

- PHP: The primary programming language used for backend development.
- MySQL: A relational database management system used for data storage.
- JavaScript: Used for server-side scripting and handling backend functionality.
- Selenium: A tool for automated testing and browser automation.

## Getting Started

To set up the project locally, follow these steps:

1. Clone the repository:

```shell
git clone https://github.com/your-username/parking-booking-backend.git
```

2. Set up the necessary server environment:

   - Ensure you have PHP and a web server (such as Apache or Nginx) installed on your local machine.
   - Configure the web server to serve the project's files.

3. Set up the MySQL database:

   - Import the provided SQL script to create the necessary database schema and tables.
   - Update the database connection settings in the project files to match your local configuration.

4. Start the web server and access the API endpoints through your preferred API testing tool (e.g., Postman).

## API Documentation

The Parking Booking Backend exposes the following API endpoints:

- `POST /register`: Used for user registration.
- `POST /login`: Used for user login and authentication.
- `GET /parking-spaces`: Retrieves a list of available parking spaces.
- `GET /parking-spaces/{id}`: Retrieves detailed information about a specific parking space.
- `POST /bookings`: Creates a new parking booking.
- `GET /bookings`: Retrieves a list of a user's bookings.
- `GET /bookings/{id}`: Retrieves detailed information about a specific booking.
- `PUT /bookings/{id}`: Updates the details of a specific booking.
- `DELETE /bookings/{id}`: Cancels a specific booking.

Please refer to the API documentation for detailed information on request and response formats.

## Contributing

Contributions to the Parking Booking Backend are welcome! If you encounter any issues or have suggestions for improvements, please open an issue or submit a pull request.

Before contributing, please review the [Contribution Guidelines](CONTRIBUTING.md) for more details.

## License

The Parking Booking Backend is open-source and released under the [MIT License](LICENSE).

## Contact

For any questions or inquiries, please contact:

- Ubaid: kunwarubaid3006@gmail.com
- Shashikant: imshashikantdev3@gmail.com

Feel free to reach out with any feedback, suggestions, or collaboration opportunities.

---
