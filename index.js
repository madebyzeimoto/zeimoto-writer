// ==========================================================
// Plugins :: zeimoto :: Writer
// ==========================================================
//
// Registers the inline-only writer field with the Kirby Panel.
//
// ==========================================================

panel.plugin("zeimoto/writer", {
  fields: {
    "zeimoto-writer": {
      extends: "k-writer-field",
    },
  },
})
