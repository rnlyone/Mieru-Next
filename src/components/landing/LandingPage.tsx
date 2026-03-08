import fs from "node:fs/promises";
import path from "node:path";
import VendorScripts from "./VendorScripts";

function extractBodyInnerHtml(html: string) {
  const match = html.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
  if (!match) return html;
  return match[1];
}

function stripScriptTags(html: string) {
  return html.replace(/<script\b[^>]*>[\s\S]*?<\/script>/gi, "");
}

export default async function LandingPage() {
  const filePath = path.join(process.cwd(), "public", "index.html");
  const fileContent = await fs.readFile(filePath, "utf8");
  const bodyInnerHtml = stripScriptTags(extractBodyInnerHtml(fileContent));

  return (
    <>
      <div dangerouslySetInnerHTML={{ __html: bodyInnerHtml }} />
      <VendorScripts />
    </>
  );
}
