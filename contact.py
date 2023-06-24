#!/usr/bin/env python

import cgi

form = cgi.FieldStorage()

name = form.getvalue('name')
email = form.getvalue('email')
message = form.getvalue('message')

# Process the form data and send an email or store it in a database

print("Content-Type: text/html\n")
print("<h1 class='glitch-effect'>Thank you for reaching out!</h1>")
print("<p>Your message has been received and I'll get back to you soon.</p>")
