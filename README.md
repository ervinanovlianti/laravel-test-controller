# VoiceController
## Sistem Architecture
```mermaid
flowchart TD
    A[Start] --> B[Validate User]
    B -- Yes --> C[Check Existing Vote]
    C -- Yes --> D[Update Existing Vote]
    C -- No --> E[Check Owner]
    E -- No --> F[Submit Vote]
    F --> G[Redirect Success]
    D --> G
    G --> H[End]
    E -- Yes --> I[Redirect Error]
```
## Database Structure
- Question
  - id
  - user_id
  - content
- Voice
  - id
  - user_id
  - question_id
  - value
## Endpoint
- GET /api/questions: Mendapatkan daftar pertanyaan.
- GET /api/voices: Mendapatkan daftar voices
- POST /api/voice/{question}: Memberikan suara pada pertanyaan tertentu.
