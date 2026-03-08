import type { Metadata } from "next";
import { Inter, Lexend } from "next/font/google";
import "./globals.css";

const inter = Inter({
  variable: "--font-inter",
  subsets: ["latin"],
  weight: ["400", "500", "600", "700", "800", "900"],
});

const lexend = Lexend({
  variable: "--font-lexend",
  subsets: ["latin"],
  weight: ["700"],
});

export const metadata: Metadata = {
  title: "Mieru — Empowering Indonesia's Future Talent",
  description:
    "Join Mieru's Product Development Internship program. We bridge the gap between education and industry through real-world mentorship.",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <head>
        <link rel="icon" type="image/x-icon" href="/assets/imgs/logo/favicon.png" />
        <link rel="stylesheet" href="/assets/vendor/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/vendor/fontawesome.min.css" />
        <link rel="stylesheet" href="/assets/vendor/swiper-bundle.min.css" />
        <link rel="stylesheet" href="/assets/vendor/meanmenu.min.css" />
        <link rel="stylesheet" href="/assets/vendor/magnific-popup.css" />
        <link rel="stylesheet" href="/assets/vendor/animate.min.css" />
        <link rel="stylesheet" href="/assets/css/style%EF%B9%96v=1.0.css" />
      </head>
      <body suppressHydrationWarning className={`${inter.variable} ${lexend.variable} antialiased body-wrapper body-digital-agency font-heading-instrumentsans-medium`}>
        {children}
      </body>
    </html>
  );
}
