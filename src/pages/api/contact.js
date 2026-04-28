import nodemailer from 'nodemailer';

export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ message: 'Method not allowed' });
  }

  const { name, email, inquiry, message } = req.body;

  if (!name?.trim() || !email?.trim() || !message?.trim()) {
    return res.status(422).json({ message: 'Name, email, and message are required.' });
  }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    return res.status(422).json({ message: 'Invalid email address.' });
  }

  try {
    if (process.env.EMAIL_USER && process.env.EMAIL_PASS) {
      const transporter = nodemailer.createTransport({
        service: process.env.EMAIL_SERVICE || 'gmail',
        auth: {
          user: process.env.EMAIL_USER,
          pass: process.env.EMAIL_PASS,
        },
      });

      await transporter.sendMail({
        from:    `"Portfolio Contact" <${process.env.EMAIL_USER}>`,
        to:      process.env.EMAIL_TO || 'becera.kian@gmail.com',
        replyTo: email,
        subject: `[Portfolio] New message from ${name}`,
        html: `
          <h2>New Contact Form Submission</h2>
          <p><strong>Name:</strong> ${name}</p>
          <p><strong>Email:</strong> ${email}</p>
          ${inquiry ? `<p><strong>Purpose:</strong> ${inquiry}</p>` : ''}
          <p><strong>Message:</strong></p>
          <p>${message.replace(/\n/g, '<br>')}</p>
        `,
      });
    }

    return res.status(200).json({ message: 'Message sent successfully.' });
  } catch (err) {
    console.error('Contact email error:', err);
    return res.status(500).json({ message: 'Failed to send message. Please try again.' });
  }
}
