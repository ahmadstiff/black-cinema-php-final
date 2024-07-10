<style>
    .accordion-toggle {
        transition: all 0.3s;
    }

    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

    .accordion.active .accordion-content {
        max-height: 1000px;
        /* Adjust max-height as needed */
    }
</style>

<body class="bg-gray-800 text-gray-200">
    <section class="py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <h6 class="text-lg font-large text-center mb-2">
                    FAQs
                </h6>
                <h2 class="text-4xl font-manrope text-center font-bold leading-[3.25rem]">
                    Pertanyaan pengguna
                </h2>
            </div>

            <div class="accordion-group">
                <!-- FAQ items will be inserted here by JavaScript -->
            </div>
        </div>
    </section>

    <script>
        const faqs = [{
                question: "Bagaimana cara membuat akun?",
                answer: "Untuk daftar akun, klik ikon profil pada navigasi bar, lalu klik tombol 'Sign Up'. Anda akan diarahkan untuk mendaftar dengan menginputkan email dan password atau menggunakan Google."
            },
            {
                question: "Bagaimana cara memesan ruang?",
                answer: "Untuk memesan ruang, klik film yang ingin Anda tonton, lalu klik 'Order Tiket'. Pilih ruang atau paket yang tersedia, dan Anda akan diarahkan ke halaman pembayaran."
            },
            {
                question: "Apa saja metode pembayaran yang tersedia?",
                answer: "Kami menerima berbagai metode pembayaran termasuk kartu kredit, transfer bank, dan e-wallet seperti GoPay dan OVO."
            },
            {
                question: "Bagaimana cara membatalkan pesanan?",
                answer: "Untuk membatalkan pesanan, masuk ke akun Anda, buka riwayat pesanan, dan klik 'Batalkan Pesanan'."
            },
            {
                question: "Apakah ada diskon untuk anggota?",
                answer: "Ya, anggota yang terdaftar dapat menikmati diskon eksklusif dan penawaran khusus."
            },
            {
                question: "Bagaimana cara menghubungi layanan pelanggan?",
                answer: "Anda dapat menghubungi layanan pelanggan melalui email di support@example.com atau melalui live chat di situs kami."
            }
        ];

        function toggleAccordion(index) {
            const accordionContent = document.querySelectorAll('.accordion-content');
            const currentAccordion = accordionContent[index].parentNode;

            if (currentAccordion.classList.contains('active')) {
                accordionContent[index].style.maxHeight = null;
                currentAccordion.classList.remove('active');
            } else {
                accordionContent.forEach((item, idx) => {
                    item.style.maxHeight = null;
                    item.parentNode.classList.remove('active');
                });

                accordionContent[index].style.maxHeight = accordionContent[index].scrollHeight + 'px';
                currentAccordion.classList.add('active');
            }
        }

        function createFAQItem(faq, index) {
            return `
                <div class="accordion py-8 px-6 border-b border-solid border-gray-200 transition-all rounded-2xl hover:bg-gray-700">
                    <button class="accordion-toggle group inline-flex items-center justify-between leading-8 w-full transition text-left font-medium" onclick="toggleAccordion(${index})">
                        <h5>${faq.question}</h5>
                        <svg class="transition" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <div class="accordion-content w-full px-0 overflow-hidden transition-max-height ease-in-out">
                        <p class="text-base leading-6 mt-4">${faq.answer}</p>
                    </div>
                </div>
            `;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const accordionGroup = document.querySelector('.accordion-group');
            faqs.forEach((faq, index) => {
                accordionGroup.innerHTML += createFAQItem(faq, index);
            });
        });
    </script>
</body>