"use client";

import { FormEvent, useState } from "react";
import Link from "next/link";
import "./join.css";

export default function JoinInternshipPage() {
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState<{ type: "success" | "error"; text: string } | null>(null);

  async function onSubmit(e: FormEvent<HTMLFormElement>) {
    e.preventDefault();
    setLoading(true);
    setMessage(null);

    const form = e.currentTarget;
    const fd = new FormData(form);

    const params = {
      full_name: fd.get("fullName") as string,
      nickname: fd.get("nickname") as string,
      email: fd.get("email") as string,
      birthday: fd.get("birthday") as string,
      university: fd.get("university") as string,
      faculty_major: fd.get("facultyMajor") as string,
      position: fd.get("interestedPosition") as string,
    };

    try {
      const res = await fetch("/send-email.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(params),
      });
      const data = await res.json();
      if (res.ok && data.success) {
        setMessage({ type: "success", text: data.message });
        form.reset();
      } else {
        setMessage({ type: "error", text: data.message || "Failed to send. Please try again later." });
      }
    } catch {
      setMessage({ type: "error", text: "Failed to send. Please try again later." });
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="join-page">
      {/* Ambient glows */}
      <div className="join-glow join-glow--orange" />
      <div className="join-glow join-glow--blue" />

      {/* Back */}
      <Link href="/" className="join-back">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
        </svg>
        Back
      </Link>

      {/* 2-column wrapper */}
      <div className="join-wrapper">

        {/* Left — intro */}
        <div className="join-intro">
          <span className="join-badge">Internship Program</span>
          <h1 className="join-title">Join Mieru</h1>
          <p className="join-subtitle">
            Start your journey in empowering Makassar&apos;s human resources
            for the AI era through practical, real-world work.
          </p>
          <div className="join-intro-features">
            <div className="join-intro-feature">
              <span className="join-intro-icon">✦</span>
              <span>3 specialized tracks</span>
            </div>
            <div className="join-intro-feature">
              <span className="join-intro-icon">✦</span>
              <span>Hands-on mentorship</span>
            </div>
            <div className="join-intro-feature">
              <span className="join-intro-icon">✦</span>
              <span>Real-world projects</span>
            </div>
          </div>
        </div>

        {/* Right — form card */}
        <div className="join-card">
          <form className="join-form" onSubmit={onSubmit}>
          {/* Row: Full Name + Nickname */}
          <div className="join-row">
            <div className="join-field">
              <label className="join-label" htmlFor="fullName">Full Name</label>
              <input className="join-input" id="fullName" name="fullName" type="text" placeholder="John Doe" required />
            </div>
            <div className="join-field">
              <label className="join-label" htmlFor="nickname">Nickname</label>
              <input className="join-input" id="nickname" name="nickname" type="text" placeholder="John" required />
            </div>
          </div>

          {/* Email */}
          <div className="join-field">
            <label className="join-label" htmlFor="email">Email</label>
            <input className="join-input" id="email" name="email" type="email" placeholder="you@example.com" required />
          </div>

          {/* Birthday */}
          <div className="join-field">
            <label className="join-label" htmlFor="birthday">Birthday</label>
            <input className="join-input" id="birthday" name="birthday" type="date" required />
          </div>

          {/* Row: University + Faculty */}
          <div className="join-row">
            <div className="join-field">
              <label className="join-label" htmlFor="university">University</label>
              <input className="join-input" id="university" name="university" type="text" placeholder="University of …" required />
            </div>
            <div className="join-field">
              <label className="join-label" htmlFor="facultyMajor">Faculty &amp; Major</label>
              <input className="join-input" id="facultyMajor" name="facultyMajor" type="text" placeholder="CS / IT / …" required />
            </div>
          </div>

          {/* Position */}
          <div className="join-field">
            <label className="join-label" htmlFor="interestedPosition">Interested Position</label>
            <select className="join-select" id="interestedPosition" name="interestedPosition" required defaultValue="">
              <option value="" disabled>Select a position</option>
              <option value="Marketing">Marketing</option>
              <option value="Programmer">Programmer</option>
              <option value="Graphic Designer">Graphic Designer</option>
            </select>
          </div>

          {/* Submit */}
          <button className="join-submit" type="submit" disabled={loading}>
            {loading ? "Sending…" : "Submit Application"}
          </button>

          {/* Message */}
          {message && (
            <div className={`join-message ${message.type === "success" ? "join-message--success" : "join-message--error"}`}>
              {message.text}
            </div>
          )}
          </form>
        </div>
      </div>
    </div>
  );
}
