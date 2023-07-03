// $(document).ready(function () {
//   // register
//   // $.validator.addMethod(
//   //   "email",
//   //   function (value, element) {
//   //     return (
//   //       this.optional(element) ||
//   //       /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value)
//   //     );
//   //   },
//   //   "Please enter a valid email address."
//   // );

//   // $.validator.addMethod(
//   //   "fname",
//   //   function (value, element) {
//   //     return this.optional(element) || /^[a-zA-Z._-]{3,16}$/i.test(!value);
//   //   },
//   //   "Username are alphabets characters"
//   // );

//   // $.validator.addMethod(
//   //   "pass",
//   //   function (value, element) {
//   //     return (
//   //       this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{8}$/i.test(value)
//   //     );
//   //   },
//   //   "Passwords are 8 characters"
//   // );

//   // modal
//   $.validator.addMethod(
//     "alpha",
//     function (value, element) {
//       return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
//       // --
//     },
//     "letter and space allowed"
//   );


//   // //   login
//   // $("#loginForm").validate({
//   //   rules: {
//   //     email: {
//   //       required: true,
//   //     },
//   //     pass: {
//   //       required: true,
//   //     },
//   //   },
//   //   messages: {
//   //     email: {
//   //       required: "please enter  email ",
//   //     },
//   //     pass: {
//   //       required: "enter password",
//   //     },
//   //   },
//   // });

//   //   insert and update
//   $("#addForm").validate({
//     // onsubmit: false,
//     // focusInvalid: false,
//     // onfocusout: false,
//     rules: {
//       book_name: {
//         required: true,
//         alpha: true,
//       },
//       description: {
//         required: true,
//       },
//       no_of_page: {
//         required: true,
//         number: true
//       },
//       author: {
//         required: true,
//         alpha: true,
//       },
//       category: {
//         required: true,
//         alpha: true,
//       },
//       price: {
//         required: true,
//         number: true
//       },
//       released_year: {
//         required: true,
//         maxlength: 4,
//       },
//       status: {
//         required: true,
//       },
//     },
//     messages: {
//       book_name: {
//         required: "please enter  book name",
//         alpha: "letter only",

//       },
//       description: {
//         required: "enter book description 3-20 characters",
//       },
//       no_of_page: {
//         required: " enter no_page",
//         number: "only digit accepet"
//       },
//       author: {
//         required: " enter author",
//         alpha: "letter only",
//       },
//       category: {
//         required: "enter category",
//         alpha: "letter only",
//       },
//       price: {
//         required: "enter price",
//         number: "only digit accepet"
//       },
//       released_year: {
//         required: "enter released_year",
//         maxlength: "4 length",
//       },
//       status: {
//         required: "enter status",
//       },
//     },
//   });

//   // register
//   // validator = $("#Register").validate({
//   //   rules: {
//   //     fname: {
//   //       required: true,
//   //     },
//   //     email: {
//   //       required: true,
//   //       remote: {
//   //         url: "checkEmail.php",
//   //         type: "post"
//   //        }
//   //     },
//   //     pass: {
//   //       required: true,
//   //       maxlength: 8,
//   //     },
//   //     gender: {
//   //       required: function (elem) {
//   //         return $("input.select:checked").length >= 0;
//   //       },
//   //     },
//   //     "hobby[]": {
//   //       required: function (elem) {
//   //         return $("input.select:checked").length >= 0;
//   //       },
//   //     },
//   //     file: {
//   //       required: true,
//   //     },
//   //   },
//   //   messages: {
//   //     fname: {
//   //       required: "please enter your first name",
//   //     },
//   //     email: {
//   //       required: "enter your email",
//   //       remote: "Email already in use!"
//   //     },
//   //     pass: {
//   //       required: " enter password",
//   //       maxlength: "8 alllowed",
//   //     },
//   //     gender: {
//   //       required: "select gender",
//   //     },
//   //     "hobby[]": {
//   //       required: "select interest",
//   //     },
//   //     file: {
//   //       required: "select photo",
//   //     },
//   //   },
//   // });
// });
