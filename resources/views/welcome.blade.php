@extends('layouts.app')

@section('content')

<br><br>
    <div class="flex flex-col items-center justify-center h-screen bg-gradient-to-br from-yellow-100 via-pink-100 to-blue-100 animate-fade-in overflow-hidden"></div></div>
        <div class="relative bg-white/90 rounded-3xl shadow-2xl p-10 max-w-3xl w-full text-center backdrop-blur-md animate-slide-up overflow-hidden">
            <!-- Decorative Images -->
            <img src="https://img.icons8.com/color/96/auction.png" alt="Auction" class="absolute left-6 top-6 w-20 h-20 animate-bounce-slow opacity-80" />
            <img src="https://img.icons8.com/color/96/handicraft.png" alt="Handicraft" class="absolute right-6 top-10 w-16 h-16 animate-float opacity-70" />
            <img src="https://img.icons8.com/color/96/market-square.png" alt="Market" class="absolute left-10 bottom-8 w-16 h-16 animate-float-reverse opacity-60" />
            <img src="https://img.icons8.com/color/96/parcel.png" alt="Parcel" class="absolute right-8 bottom-6 w-14 h-14 animate-bounce-slow opacity-60" />

            <h1 class="text-5xl font-extrabold text-pink-700 drop-shadow mb-4 animate-fade-in-down">
                Welcome to Nepali Auction!
            </h1>
            <p class="mt-2 text-lg text-gray-700 font-medium animate-fade-in">
                Buy and sell authentic Nepali products, handicrafts, antiques, and unique items.<br>
            </p>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                <div class="bg-gradient-to-r from-yellow-200 to-pink-100 rounded-xl p-6 shadow-md animate-fade-in-up flex items-center gap-4">
                    <img src="https://img.icons8.com/color/48/hammer.png" alt="Bid" class="w-12 h-12" />
                    <div>
                        <h2 class="text-xl font-bold text-pink-700">Easy Bidding</h2>
                        <p class="text-gray-700 text-sm">Join auctions for Nepali art, crafts, and rare items. Place your bid and win!</p>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-blue-100 to-green-100 rounded-xl p-6 shadow-md animate-fade-in-up flex items-center gap-4 delay-100">
                    <img src="https://img.icons8.com/color/48/handshake.png" alt="Trust" class="w-12 h-12" />
                    <div>
                        <h2 class="text-xl font-bold text-blue-700">Trusted Marketplace</h2>
                        <p class="text-gray-700 text-sm">Verified sellers and buyers. Safe payments and fast delivery all over Nepal.</p>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-pink-100 to-yellow-100 rounded-xl p-6 shadow-md animate-fade-in-up flex items-center gap-4 delay-200">
                    <img src="https://img.icons8.com/color/48/customer-support.png" alt="Support" class="w-12 h-12" />
                    <div>
                        <h2 class="text-xl font-bold text-yellow-700">24/7 Support</h2>
                        <p class="text-gray-700 text-sm">Our team is always ready to help you with any questions or issues.</p>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-green-100 to-blue-100 rounded-xl p-6 shadow-md animate-fade-in-up flex items-center gap-4 delay-300">
                    <img src="https://img.icons8.com/color/48/delivery.png" alt="Delivery" class="w-12 h-12" />
                    <div>
                        <h2 class="text-xl font-bold text-green-700">Fast Delivery</h2>
                        <p class="text-gray-700 text-sm">Promoting Nepali products, culture, and identity.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        body {
            min-height: 100vh;
        }
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(60px);}
            to { opacity: 1; transform: translateY(0);}
        }
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0);}
            50% { transform: translateY(-15px);}
        }
        @keyframes float {
            0%, 100% { transform: translateY(0);}
            50% { transform: translateY(-8px);}
        }
        @keyframes float-reverse {
            0%, 100% { transform: translateY(0);}
            50% { transform: translateY(8px);}
        }
        .animate-fade-in { animation: fade-in 1s ease; }
        .animate-fade-in-down { animation: fade-in-down 1s ease; }
        .animate-fade-in-up { animation: fade-in-up 1.2s ease; }
        .animate-slide-up { animation: slide-up 1.2s cubic-bezier(.4,2,.6,1); }
        .animate-bounce-slow { animation: bounce-slow 2.5s infinite; }
        .animate-float { animation: float 3s infinite; }
        .animate-float-reverse { animation: float-reverse 3s infinite; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
@endsection
