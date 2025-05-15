document.addEventListener("DOMContentLoaded", function () {
  const ratioElements = document.querySelectorAll(".contrast-ratio");

  ratioElements.forEach((element) => {
    const bgColor = element.dataset.background;
    const textColor = element.dataset.text;
    const ratio = calculateContrastRatio(bgColor, textColor);
    const wcagLevel = getWCAGLevel(ratio);

    element.textContent = `Contrast Ratio: ${ratio.toFixed(
      2
    )}:1 - ${wcagLevel}`;
  });
});

function calculateContrastRatio(bg, text) {
  // Convert hex to RGB
  const bgRGB = hexToRGB(bg);
  const textRGB = hexToRGB(text);

  // Calculate luminance
  const bgLuminance = calculateLuminance(bgRGB);
  const textLuminance = calculateLuminance(textRGB);

  // Calculate ratio
  const ratio =
    (Math.max(bgLuminance, textLuminance) + 0.05) /
    (Math.min(bgLuminance, textLuminance) + 0.05);

  return ratio;
}

function hexToRGB(hex) {
  const r = parseInt(hex.slice(1, 3), 16);
  const g = parseInt(hex.slice(3, 5), 16);
  const b = parseInt(hex.slice(5, 7), 16);
  return [r, g, b];
}

function calculateLuminance([r, g, b]) {
  const [rs, gs, bs] = [r, g, b].map((c) => {
    c = c / 255;
    return c <= 0.03928 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
  });
  return 0.2126 * rs + 0.7152 * gs + 0.0722 * bs;
}

function getWCAGLevel(ratio) {
  if (ratio >= 7) return "AAA";
  if (ratio >= 4.5) return "AA";
  if (ratio >= 3) return "AA Large Text";
  return "Fail";
}
